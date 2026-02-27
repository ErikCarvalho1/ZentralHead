<?php
session_start();

// Atalho de teste: popular carrinho automaticamente quando `test_cart=1` (apenas para testes locais)
if (empty($_SESSION['carrinho']) && (($_REQUEST['test_cart'] ?? '') === '1')) {
    $_SESSION['carrinho'] = [
        [
            'id' => 1,
            'qtd' => 1,
            'preco' => 1.00
        ]
    ];
}

/* ==========================
   CONFIG
========================== */
require_once __DIR__ . '/../config/mercadopago.php'; // DEVE definir MP_ACCESS_TOKEN
require_once __DIR__ . '/../class/pedidos.php';
require_once __DIR__ . '/../class/itempedido.php';
require_once __DIR__ . '/../class/pagamentos.php';

/* ==========================
   1️⃣ VALIDAR CARRINHO
========================== */
if (empty($_SESSION['carrinho'])) {
    http_response_code(400);
    exit('Carrinho vazio');
}

/* ==========================
   2️⃣ CLIENTE (TEMP)
========================== */
if (!isset($_SESSION['cliente_id'])) {
    $_SESSION['cliente_id'] = 1028;
}
$cliente_id = (int) $_SESSION['cliente_id'];

/* ==========================
   3️⃣ FORM
========================== */
$forma_pagamento = $_POST['forma_pagamento'] ?? null;
$total = (float) ($_POST['total'] ?? 0);

if (!$forma_pagamento || $total <= 0) {
    http_response_code(400);
    exit('Dados inválidos');
}

try {

    /* ==========================
       4️⃣ CRIAR PEDIDO
    ========================== */
    $pedido = new pedidos();
    $pedido->setCliente_id($cliente_id);
    $pedido->setStatus('pendente');

    $pedido_id = $pedido->criarPedido();

    if (!$pedido_id) {
        throw new Exception('Erro ao criar pedido');
    }

    /* ==========================
       5️⃣ ITENS DO PEDIDO
    ========================== */
    $itemPedido = new itempedido();

    // Em modo de teste (`test_cart=1`) evitamos inserir itens no banco para não depender de produtos reais
    if (($_REQUEST['test_cart'] ?? '') !== '1') {
        foreach ($_SESSION['carrinho'] as $item) {
            $itemPedido->inserir(
                $pedido_id,
                (int) $item['id'],
                (int) $item['qtd'],
                (float) $item['preco']
            );
        }
    }

    /* ==========================
       6️⃣ PIX - MERCADO PAGO
    ========================== */
    if ($forma_pagamento === 'pix') {

        $payload = [
            'transaction_amount' => round($total, 2),
            'description' => "Pedido #{$pedido_id}",
            'payment_method_id' => 'pix',
            'external_reference' => (string) $pedido_id,
            'payer' => [
                'email' => 'cliente@teste.com'
            ]
        ];

        $json = json_encode($payload, JSON_UNESCAPED_UNICODE);

        if ($json === false) {
            throw new Exception('Falha ao gerar JSON');
        }

        // 🔑 OBRIGATÓRIO
        $idempotencyKey = uniqid('pix_', true);

        $ch = curl_init('https://api.mercadopago.com/v1/payments');
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . MP_ACCESS_TOKEN,
                'Content-Type: application/json',
                'X-Idempotency-Key: ' . $idempotencyKey
            ],
            CURLOPT_POSTFIELDS => $json
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $pix = json_decode($response, true);

        if ($httpCode !== 201 || !isset($pix['id'])) {
            throw new Exception('Erro Mercado Pago: ' . $response);
        }

        /* ==========================
           7️⃣ SALVAR PAGAMENTO
        ========================== */
        $pagamento = new pagamentos();
        $pagamento->inserir(
            $pedido_id,
            'pix',
            $total,
            'pendente',
            (string) $pix['id']
        );

        /* ==========================
           8️⃣ FINALIZA
        ========================== */
        unset($_SESSION['carrinho']);

        $_SESSION['pix_qr']    = $pix['point_of_interaction']['transaction_data']['qr_code_base64'];
        $_SESSION['pix_copia'] = $pix['point_of_interaction']['transaction_data']['qr_code'];
        $_SESSION['pedido_id'] = $pedido_id;

        header('Location: aguardando_pix.php');
        exit;
    }

    /* ==========================
       6.1️⃣ CARTÃO DE CRÉDITO - MERCADO PAGO
    ========================== */
    if ($forma_pagamento === 'card' || $forma_pagamento === 'cartao') {

        $email = trim($_POST['email'] ?? '');
        $token = trim($_POST['token'] ?? '');
        $installments = (int) ($_POST['installments'] ?? 1);
        $payment_method_id = $_POST['payment_method_id'] ?? null;

        // Validações básicas
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('E-mail inválido');
        }

        if (empty($token)) {
            throw new Exception('Token do cartão ausente');
        }

        if (empty($payment_method_id)) {
            throw new Exception('Forma de pagamento inválida');
        }

        // Montar payload
        $payload = [
            'transaction_amount' => round($total, 2),
            'token' => $token,
            'description' => "Pedido #{$pedido_id}",
            'installments' => $installments,
            'payment_method_id' => $payment_method_id,
            'payer' => [
                'email' => $email
            ],
            'external_reference' => (string) $pedido_id
        ];

        $json = json_encode($payload, JSON_UNESCAPED_UNICODE);
        if ($json === false) {
            throw new Exception('Falha ao gerar JSON');
        }

        // Idempotency key obrigatória
        $idempotencyKey = uniqid('card_', true);

        // Modo MOCK para testes locais (só quando MP_DEBUG=true)
        if (defined('MP_DEBUG') && MP_DEBUG && (($_REQUEST['mock_mp'] ?? '') === '1')) {
            $mock_status = $_REQUEST['mock_status'] ?? 'approved';
            $payment = [
                'id' => uniqid('mock_', true),
                'status' => $mock_status,
                'status_detail' => 'mock_' . $mock_status
            ];
            $httpCode = 201;
        } else {
            $ch = curl_init(MP_API_URL . '/v1/payments');
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_HTTPHEADER => [
                    'Authorization: Bearer ' . MP_ACCESS_TOKEN,
                    'Content-Type: application/json',
                    'X-Idempotency-Key: ' . $idempotencyKey
                ],
                CURLOPT_POSTFIELDS => $json
            ]);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if (curl_errno($ch)) {
                $curlErr = curl_error($ch);
            }
            curl_close($ch);

            $payment = json_decode($response, true);
        }

        // Se não retornou 201, tratar como erro da API
        if ($httpCode !== 201 || !$payment || !isset($payment['id'])) {
            // Log para depuração em modo dev
            if (defined('MP_DEBUG') && MP_DEBUG) {
                file_put_contents(__DIR__ . '/../config/log_mp_error.txt', date('c') . " - HTTP $httpCode - $response\n", FILE_APPEND);
                if (!empty($curlErr)) file_put_contents(__DIR__ . '/../config/log_mp_error.txt', "CURL: $curlErr\n", FILE_APPEND);
            }

            // Salvar tentativa com status de erro
            $pagamento = new pagamentos();
            $pagamento->inserir($pedido_id, 'cartao', $total, 'erro', null);

            // Exibir mensagem amigável ao usuário
            http_response_code(502);
            echo '<h2>Erro ao processar pagamento</h2>';
            echo '<p>Ocorreu um problema ao processar seu pagamento. Tente novamente mais tarde ou utilize outro meio de pagamento.</p>';
            exit;
        }

        // Resposta válida da API
        $status = $payment['status'] ?? '';
        $transactionId = (string) ($payment['id'] ?? '');

        // Mapear status Mercado Pago -> status interno
        $mapStatus = [
            'approved' => 'pago',
            'pending'  => 'pendente',
            'rejected' => 'cancelado'
        ];

        $internalStatus = $mapStatus[$status] ?? 'pendente';

        // Salvar pagamento com status e payment_id
        $pagamento = new pagamentos();
        $pagamento->inserir($pedido_id, 'cartao', $total, $internalStatus, $transactionId);

        // Ações por status
        if ($status === 'approved') {
            // Confirmar pagamento e pedido
            $pagamento->confirmarPagamento($pedido_id, $transactionId);
            unset($_SESSION['carrinho']);
            header("Location: pedido_sucesso.php?pedido_id={$pedido_id}");
            exit;
        }

        if ($status === 'pending') {
            // Pagamento pendente - informar usuário
            echo '<h2>Pagamento pendente</h2>';
            echo '<p>Seu pagamento está sendo processado. Assim que confirmado, você será notificado.</p>';
            exit;
        }

        // rejected ou outros - exibir mensagem amigável
        $detail = $payment['status_detail'] ?? '';
        echo '<h2>Pagamento recusado</h2>';
        echo '<p>Seu pagamento foi recusado. Motivo: ' . htmlspecialchars($detail) . '</p>';
        exit;
    }

} catch (Exception $e) {
    http_response_code(500);
    exit('Erro: ' . $e->getMessage());
}

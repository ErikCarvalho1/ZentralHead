<?php
session_start();

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

    foreach ($_SESSION['carrinho'] as $item) {
        $itemPedido->inserir(
            $pedido_id,
            (int) $item['id'],
            (int) $item['qtd'],
            (float) $item['preco']
        );
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

} catch (Exception $e) {
    http_response_code(500);
    exit('Erro: ' . $e->getMessage());
}

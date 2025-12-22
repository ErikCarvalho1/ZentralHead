<?php
session_start();

require_once "../class/pedidos.php";
require_once "../class/itempedido.php";
require_once "../class/pagamentos.php";

/* ==========================
   1️⃣ VALIDAR CARRINHO
========================== */
if (empty($_SESSION['carrinho'])) {
    die("Carrinho vazio.");
}

/* ==========================
   2️⃣ VALIDAR CLIENTE
========================== */

// ⚠️ TEMPORÁRIO PARA TESTES
if (!isset($_SESSION['cliente_id'])) {
    // REMOVA isso quando o login estiver 100%
    $_SESSION['cliente_id'] = 1028;
}

$cliente_id = $_SESSION['cliente_id'];

if (!$cliente_id) {
    die("Cliente não autenticado.");
}

/* ==========================
   3️⃣ DADOS DO FORMULÁRIO
========================== */
$forma_pagamento = $_POST['forma_pagamento'] ?? null;
$total           = $_POST['total'] ?? 0;

if (!$forma_pagamento || $total <= 0) {
    die("Dados inválidos.");
}

try {

    /* ==========================
       4️⃣ CRIAR PEDIDO
    ========================== */
 $pedido = new pedidos();
$pedido->setCliente_id($cliente_id);
$pedido->setStatus('A');

$pedido_id = $pedido->criarPedido();

    /* ==========================
       5️⃣ INSERIR ITENS DO PEDIDO    
    ========================== */
    $itemPedido = new itempedido();

    foreach ($_SESSION['carrinho'] as $item) {

        if (
            empty($item['id']) ||
            empty($item['qtd']) ||
            empty($item['preco'])
        ) {
            continue;
        }

        $itemPedido->inserir(
            $pedido_id,
            $item['id'],      // produto_id
            $item['qtd'],     // quantidade
            $item['preco']    // preço
        );
    }

    /* ==========================
       6️⃣ REGISTRAR PAGAMENTO
    ========================== */
    $pagamento = new pagamentos();
    $pagamento->inserir(
        $pedido_id,
        $forma_pagamento,
        $total
    );

    /* ==========================
       7️⃣ LIMPAR CARRINHO
    ========================== */
    unset($_SESSION['carrinho']);

} catch (Exception $e) {
    die("Erro ao finalizar pedido: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pedido Finalizado</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5 text-center">
    <h2 class="text-success">✅ Pedido realizado com sucesso!</h2>

    <p class="mt-3">
        Número do pedido:
        <strong>#<?= $pedido_id ?></strong>
    </p>

    <a href="index.php" class="btn btn-primary mt-4">
        Voltar para a loja
    </a>
</div>

</body>
</html>

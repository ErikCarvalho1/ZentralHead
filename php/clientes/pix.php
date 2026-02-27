<?php
require_once "../class/pagamentos.php";

$pedido_id = $_GET['pedido_id'] ?? null;

if (!$pedido_id) {
    die("Pedido inválido.");
}

// SIMULA pagamento confirmado
$pagamento = new pagamentos();
$pagamento->confirmarPagamento($pedido_id, 'PIX'.time());

echo "✅ Pagamento PIX confirmado!";
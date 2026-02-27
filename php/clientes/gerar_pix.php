<?php
require_once __DIR__ . '/../config/mercadopago.php';
require_once __DIR__ . '/../class/pedidos.php';
require_once __DIR__ . '/../class/pagamentos.php';

use MercadoPago\Client\Payment\PaymentClient;

header('Content-Type: application/json');

if (!isset($_POST['pedido_id'])) {
    echo json_encode(['erro' => 'Pedido inválido']);
    exit;
}

$pedido_id = (int) $_POST['pedido_id'];

$pedidoClass = new Pedidos();
$pedido = $pedidoClass->buscarPorId($pedido_id);

if (!$pedido) {
    echo json_encode(['erro' => 'Pedido não encontrado']);
    exit;
}

$client = new PaymentClient();

$pagamentoMP = $client->create([
    "transaction_amount" => (float) $pedido['total'],
    "payment_method_id"  => "pix",
    "description"        => "Pedido #{$pedido_id}",
    "payer" => [
        "email" => $pedido['email_cliente']
    ]
]);

// 💾 SALVAR NO BANCO
$pagamentoClass = new Pagamentos();
$pagamentoClass->inserir(
    $pedido_id,
    'pix',
    $pedido['total'],
    'pendente',
    $pagamentoMP->id
);

// 🔁 RETORNO PARA O FRONT
echo json_encode([
    'status' => 'ok',
    'pix' => [
        'qr_code' => $pagamentoMP->point_of_interaction->transaction_data->qr_code,
        'qr_code_base64' => $pagamentoMP->point_of_interaction->transaction_data->qr_code_base64,
        'valor' => $pedido['total']
    ]
]);

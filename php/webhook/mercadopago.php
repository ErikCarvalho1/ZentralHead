<?php
require_once __DIR__ . '/../config/mercadopago.php';
require_once __DIR__ . '/../config/conexao.php';

// Sempre responder 200
http_response_code(200);

// Ler payload
$raw = file_get_contents('php://input');
if (!$raw) exit('Sem payload');

// Converter JSON
$data = json_decode($raw, true);
if (json_last_error() !== JSON_ERROR_NONE) exit('JSON inválido');

// Log
file_put_contents(
    __DIR__ . '/log_webhook.txt',
    date('Y-m-d H:i:s') . ' ' . $raw . PHP_EOL,
    FILE_APPEND
);

// Validar evento
if (($data['type'] ?? '') !== 'payment') {
    exit('Evento ignorado');
}

$paymentId = $data['data']['id'] ?? null;
if (!$paymentId) exit('Payment ID ausente');

// Consultar pagamento
$ch = curl_init(MP_API_URL . "/v1/payments/$paymentId");
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        'Authorization: Bearer ' . MP_ACCESS_TOKEN
    ]
]);

$response = curl_exec($ch);
curl_close($ch);

$payment = json_decode($response, true);
if (!$payment || !isset($payment['status'])) {
    exit('Erro ao consultar pagamento');
}

// Mapear status
$mapStatus = [
    'approved' => 'pago',
    'pending'  => 'pendente',
    'rejected' => 'cancelado'
];

$status = $mapStatus[$payment['status']] ?? 'pendente';
$transactionCode = $payment['id'];

// Atualizar banco
$stmt = $pdo->prepare("
    UPDATE pagamentos
    SET status = ?
    WHERE codigo_transacao = ?
");

$stmt->execute([$status, $transactionCode]);

echo 'OK';

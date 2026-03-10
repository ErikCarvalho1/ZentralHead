<?php
require_once __DIR__ . '/../config/conexao.php';

$pedido_id = (int) ($_GET['pedido_id'] ?? 0);

$stmt = $pdo->prepare("
    SELECT status 
    FROM pagamentos 
    WHERE pedido_id = ?
    LIMIT 1
");

$stmt->execute([$pedido_id]);
$status = $stmt->fetchColumn();

echo json_encode([
    'status' => $status ?: 'pendente'
]);

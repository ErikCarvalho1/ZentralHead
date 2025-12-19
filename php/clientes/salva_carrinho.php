<?php
session_start();
header('Content-Type: application/json');

$dados = json_decode(file_get_contents('php://input'), true);

if (!isset($dados['carrinho']) || !is_array($dados['carrinho'])) {
    echo json_encode(['ok' => false]);
    exit;
}

// 🔥 SOBRESCREVE qualquer carrinho anterior (mock ou velho)
$_SESSION['carrinho'] = $dados['carrinho'];

echo json_encode(['ok' => true]);

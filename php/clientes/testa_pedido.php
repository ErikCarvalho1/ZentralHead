<?php
require_once "../class/db.php";
require_once "../class/pedidos.php";

$pedido = new Pedidos();
$pedido->setCliente_id(1028); // ID REAL DA TABELA cliente
$pedido->setStatus('pendente');

$pedidoId = $pedido->criarPedido();
echo "Pedido criado com ID: " . $pedidoId;



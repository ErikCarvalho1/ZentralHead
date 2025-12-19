<?php
require_once "../class/db.php";
require_once "../class/enderecos.php";

$end = new enderecos();
$end->setCliente_id(1028); // cliente existente
$end->setPedido_id(100054);  // pedido existente (ou null)
$end->setRua("Rua das Flores");
$end->setNumero("123");
$end->setBairro("Centro");
$end->setCidade("São Paulo");
$end->setEstado("SP");
$end->setCep("01000-000");

$end->inserir();

echo "Endereço salvo com sucesso!";

<?php
require_once "../class/db.php";
require_once "../class/itempedido.php";

$item = new Itempedido();
$item->setPedido_id(100054); // ID REAL de pedido criado
$item->setProduto_id(24);    // ID REAL da tabela produtos
$item->setQuantidade(2);
$item->setPreco(99.90);

$item->inserir();

echo "Item inserido com sucesso!";

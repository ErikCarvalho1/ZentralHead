<?php
require_once "../class/pagamentos.php";

$p = new pagamentos();
$p->setPedido_id(100055);
$p->setForma_pagamento("pix");
$p->setValor(199.90);
$p->setStatus("pendente");
$p->setCodigo_transacao(null);
$p->inserir();


echo "Pagamento registrado!";

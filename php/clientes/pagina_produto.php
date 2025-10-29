<?php include "produtos.php";
include " cabecalho.php";

if (!isset($_GET['id'])){     //!isset verifica se a variavel não existe
    die ("Produro não encontrado");
}

$id =(int) $_GET['id'];

$prod = new produtos();
$produto = $prod->listarPorId($id);

if(!$produto){
    die("produto não encontrado");
}
?>


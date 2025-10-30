<?php 
session_start();

$id = $_GET['id'];
$nome = $_GET['nome'];
$preco = $_GET['preco'];

if(!isset($_SESSION['carrinho'])){
    $_SESSION['carrinho'] = [];
}

// se já existe o produto, aumenta a quantidade
if(isset($_SESSION['carrinho'][$id])){
    $_SESSION['carrinho'][$id]['quantidade']++;
} else {
    $_SESSION['carrinho'][$id] = [
        'id' => $id,
        'nome' => $nome,
        'preco' => $preco,
        'quantidade' => 1
    ];
}

header("Location: carrinho.php");
exit;
?>

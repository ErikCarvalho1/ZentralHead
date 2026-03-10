<?php
$pedido_id = (int) ($_GET['pedido_id'] ?? 0);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pedido confirmado</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="card p-4">
        <h3>Pagamento confirmado ✅</h3>
        <p>Obrigado! Seu pedido <strong>#<?= $pedido_id ?></strong> foi confirmado.</p>
        <a href="/ZentralHead/index.php" class="btn btn-primary">Continuar comprando</a>
    </div>
</div>
</body>
</html>

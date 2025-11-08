<?php
// ...existing code...
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Carrinho</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/style.css" />
    <script src="../../js/bootstrap.bundle.min.js" defer></script>
    <style>
        .cart-img { width:64px; height:64px; object-fit:contain; }
    </style>
</head>
<body>

<!-- Botão do carrinho -->
<button class="btn btn-primary position-fixed" type="button" 
        data-bs-toggle="offcanvas" data-bs-target="#carrinhoOffcanvas" 
        style="bottom: 20px; right: 20px; z-index: 1050;">
    <i class="bi bi-cart3"></i>
    <span class="badge bg-danger" id="cart-count">0</span>
</button>


<!-- Offcanvas do Carrinho -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="carrinhoOffcanvas">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Meu Carrinho</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <div id="cart-empty" class="alert alert-info" style="display:none;">
            Seu carrinho está vazio.
        </div>

        <div id="cart-list" class="list-group mb-3"></div>

        <div id="cart-summary" class="mt-auto" style="display:none;">
            <div class="d-flex justify-content-between mb-3">
                <strong>Total:</strong>
                <strong>R$ <span id="cart-total">0,00</span></strong>
            </div>
            
            <div class="d-grid gap-2">
                <button id="clear-cart" class="btn btn-outline-danger">Limpar carrinho</button>
                <a href="/ZentralHead/php/menu_publico/produtos-destaques.php" class="btn btn-secondary">Continuar comprando</a>
                <button id="checkout-btn" class="btn btn-success">Finalizar compra</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>

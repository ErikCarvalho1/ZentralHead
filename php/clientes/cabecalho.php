<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
<script src="/ZentralHead/js/carrinho.js" defer></script>


<nav class="navbar navbar-expand-lg ">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="index.php">
            <img src="../../images/LogoZentral.png" alt="Logo" height="30">
        </a>

        <!-- Botão toggle para mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#defaultNavbar"
            aria-controls="defaultNavbar" aria-expanded="false" aria-label="Alternar navegação">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->

        <div class="collapse navbar-collapse" id="defaultNavbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item mx-3">
                    <a href="catalogo.php" class="text-decoration-none text-reset">Produtos</a>
                </li>
                <li class="nav-item mx-3">
                    <a href="#" class="text-decoration-none text-reset">Categorias</a>
                </li>
                <li class="nav-item mx-3">
                    <a href="#" class="text-decoration-none text-reset">Promoções</a>
            </ul>

            <ul class="navbar-nav ms-auto">
           <!-- Botão do carrinho -->
<li class="nav-item mx-3">
    <button class="btn nav-link" type="button" data-bs-toggle="offcanvas" data-bs-target="#carrinhoOffcanvas">
        <i class="bi bi-cart3"></i>
        <span class="badge bg-danger" id="cart-count">0</span>
    </button>
</li>


                <?php
    $nomeUsuario = $_SESSION['nome_usuario'] ?? 'Visitante'; 
  ?>
                Olá, <?= htmlspecialchars($nomeUsuario) ?>!
                </span>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../clientes/index.php">
                        <i class="bi bi-house"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">
                        <i class="bi bi-box-arrow-right"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

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
                <a href="/ZentralHead/php/menu_publico/produtos-destaques.php" class="btn btn-secondary">Continuar
                    comprando</a>
                <button id="checkout-btn" class="btn btn-success">Finalizar compra</button>
            </div>
        </div>
    </div>
</div>
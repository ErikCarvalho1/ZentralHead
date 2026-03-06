<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
<script src="/ZentralHead/js/carrinho.js" defer></script>
<link rel="stylesheet" href="../../css/cabeçalho.css">

<nav class="navbar navbar-expand-lg ">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="index.php">
            <img src="../../images/LogoZentral.png" alt="Logo" height="40">
        </a>

        <!-- Botão toggle para mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#defaultNavbar"
            aria-controls="defaultNavbar" aria-expanded="false" aria-label="Alternar navegação">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->

        <div class="a collapse navbar-collapse" id="defaultNavbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item mx-3">
                    <a href="produtos.php" class="text-decoration-none text-reset">Produtos</a>
                </li>
                <li class="nav-item mx-3">
                    <a href="categorias.php" class="text-decoration-none text-reset">Categorias</a>
                </li>
                <li class="nav-item mx-3">
                    <a href="#" class="text-decoration-none text-reset">Promoções</a>
                    </li>
                    
            </ul>

            <ul class="navbar-nav ms-auto">
           <!-- Botão do usuário/login -->
<li class="nav-item ms-4">
    <a href="../clientes/login.php" class="text-decoration-none text-reset d-flex align-items-center gap-2 px-3 py-2" 
       style="border-radius: 8px; transition: all 0.3s ease; cursor: pointer;" 
       onmouseover="this.style.backgroundColor='#f0f0f0';" 
       onmouseout="this.style.backgroundColor='transparent';">
      <i class="bi bi-person-circle" style="font-size: 1.8rem;"></i>
      <span style="font-size: 0.95rem; font-weight: 500;">Entrar</span>
    </a>
</li>
            </ul>
        </div>
    </div>
</nav>

    
</div>
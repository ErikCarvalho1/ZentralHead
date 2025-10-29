<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav class="navbar navbar-expand-lg  ">
  <div class="container-fluid">
    <!-- Logo -->
    <a class="navbar-brand" href="index.php">
      <img src="../../images/LogoZentral.png" alt="Logo" height="30">
    </a>
 
    <!-- Botão toggle para mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#defaultNavbar" aria-controls="defaultNavbar" aria-expanded="false" aria-label="Alternar navegação">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <!-- Menu -->
     
    <div class="collapse navbar-collapse" id="defaultNavbar">
     <ul class="navbar-nav ms-auto"> <li class="nav-item mx-3">
  <a href="pagina.produtos.php" class="text-decoration-none text-reset">Produtos</a>
  </li>
  <li class="nav-item mx-3">
  <a href="#" class="text-decoration-none text-reset">Categorias</a>
  </li>
  <li class="nav-item mx-3">
  <a href="#" class="text-decoration-none text-reset">Promoções</a></ul>  
    <ul class="navbar-nav ms-auto">
        
        <li class="nav-item">
          <span class="btn btn-danger disabled me-2" style="cursor: default;">
            
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
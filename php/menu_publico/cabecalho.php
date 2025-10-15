  <nav class="bg-dark navbar navbar-expand-lg  shadow-sm ">
        <div class="container-fluid">
          <!-- LOGO (IMAGEM) -->
          <a class="navbar-brand" href="#">
            <img src="../../images/LogoZentral.png" alt="Logo Loja" width="120" />
          </a>

          <!-- BOTÃO RESPONSIVO -->
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarContent"
            aria-controls="navbarContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>

          <!-- MENU CENTRALIZADO -->
        <div class="collapse navbar-collapse" id="navbarContent">
  <!-- Navegação central -->
  <ul class="navbar-nav mx-auto mb-2 mb-lg-0 ">
   
    <li class="nav-item">
      <a class="nav-link text-white" href="#">Produtos</a>
    </li>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="#">Promoções</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="#">Destaques</a>
    </li>
  </ul>

  <!-- Direita: pesquisa + ícones -->
  <div class="d-flex align-items-center">
    <!-- Pesquisa -->
    <form class="d-flex me-3 text-white" role="search">
      <input
        class="form-control me-2 text-white"
        type="search"
        placeholder="Buscar produtos..."
        aria-label="Search"
      />
      <button class="btn text-white" type="submit">
        <i class="bi bi-search fs-5"></i>
      </button>
    </form>

    <!-- Ícone Carrinho -->
    <a href="#" id="openCart" class="btn me-2 text-white">
      <i class="bi bi-cart3 fs-5"></i>
    </a>

    <!-- Ícone Globo -->
    <a href="#" class="btn me-2 text-white">
      <i class="bi bi-globe2 fs-5"></i>
    </a>

    <!-- Ícone Usuário -->
    <a href="login.php" class="btn me-2 text-white">
      <i class="bi bi-person-circle fs-5"></i>
    </a>
  </div>
</div>
      </nav>
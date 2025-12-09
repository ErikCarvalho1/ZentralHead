<?php require_once __DIR__ . '/../clientes/autenticacao.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="../../css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../css/style.css" />
  <script src="../../js/bootstrap.bundle.min.js" defer></script>
  <script src="../../js/inicial.js" defer></script>
  <title>ZentralHead</title>
</head>
<body>
  <!-- CABEÇALHO -->
  <header>
    <?php include_once "../menu_publico/faixa.php";?>
    <?php include_once "cabecalho.php"; ?>
  </header>

  <!-- CONTEÚDO -->
  <main class="container my-4">
    
    <?php include_once "../menu_publico/destaque.php"; ?>
    <?php include_once "../menu_publico/produtos-destaques.php"; ?>
    <?php include_once "../menu_publico/categorias.php"; ?>
    <?php include_once "../menu_publico/promocoes.php"; ?>
  </main>

<<<<<<< HEAD
  <!-- RODAPÉ -->
  <footer class="container-fluid text-white p-4 mt-5">
    <?php include_once "../menu_publico/rodape.php"; ?> 
  </footer>
</body>
=======
  <body >
    <!-- CABEÇALHO -->
    <header>
    <div id="carouselExample" class="carousel slide">

        <div class="carousel-inner">
            <div class="carousel-item active">
                <textarea></textarea>
            </div>

            <div class="carousel-item">
                <button>ddwdw</button>
            </div>

            <div class="carousel-item">
                <textarea></textarea>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>

    </div>
</header>

</div>
    <?php include_once "cabecalho.php"?>
    </header>
    <!-- CONTEÚDO -->
    <main class="container my-4">
      <!-- DESTAQUE -->
      <?php include_once "../menu_publico/destaque.php"?>
      <!-- PRODUTOS EM DESTAQUE -->
      <?php include_once "../menu_publico/produtos-destaques.php"?>

      <!-- CATEGORIAS -->
        <?php include_once "../menu_publico/categorias.php"?>


   

     
      </main>

    <!-- RODAPÉ -->
    <footer class="container-fluid text-white p-4 mt-5">
      <?php include_once "../menu_publico/rodape.php"?> 
    </footer>
  </body>
>>>>>>> d38f7d6b398cf1c0b6d1aa896409cf9659a9e877
</html>

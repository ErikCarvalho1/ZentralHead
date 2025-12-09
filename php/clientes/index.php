<?php require_once __DIR__ . '/../clientes/autenticacao.php';?>
<!DOCTYPE html>
<body>
<!-- CARROSSEL SUPERIOR -->
<div id= "top-carousel" class="carousel slide" data-bs-ride="carousel">
<div class="carousel-inner">
   
        <div class="top-item">FRETE GRÁTIS NAS COMPRAS ACIMA DE R$250</div>
        <div class="top-item">PAGAMENTO SEGURO • PIX • CARTÃO</div>
        <div class="top-item">LANÇAMENTOS TODA SEMANA</div>
    
</div>

<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap Icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
   
    <!-- Bootstrap 5.3 -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <!-- CSS local -->
    <link rel="stylesheet" href="../../css/style.css" />

    <!-- js -->
    <script src="../../js/bootstrap.bundle.min.js" defer></script>
    <script src="../../js/inicial.js" defer></script>
    <title>ZentralHead</title>
  </head>

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
</html>

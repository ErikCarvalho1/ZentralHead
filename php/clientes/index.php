<?php require_once __DIR__ . '/../clientes/autenticacao.php';?>
<!DOCTYPE html>
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


       <!-- promoções-->
        <?php include_once "../menu_publico/promocoes.php"?>

      <!-- carrinho -->
      <?php include_once "carrinho.php"?>
      </main>

    <!-- RODAPÉ -->
    <footer class="container-fluid text-white p-4 mt-5">
      <?php include_once "../menu_publico/rodape.php"?>
    </footer>
  </body>
</html>

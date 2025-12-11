<?php require_once __DIR__ . '/../clientes/autenticacao.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="../../css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../css/style.css" />
  <link rel="stylesheet" href="../../css/card-produto-destaque.css" />
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




<!DOCTYPE html>
<?php require_once __DIR__ . '/../clientes/autenticacao.php';?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Zentral</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
</head>
<body>
    <!-- CABEÇALHO -->
    <header>
        <?php include_once "cabecalho.php"; ?>
    </header>

    <!-- CONTEÚDO -->
    <?php 
include "../class/produtos.php";
$produto = new Produtos();
$produtos = $produto->listar(1); 


$linha = count($produtos);

?>
<section class="container my-4">
    <!-- mostra se a consulta retornar vazio  -->
    <?php if($linha == 0){ ?>
        <h2 class="alert alert-danger">Não há produtos em destaques</h2>
    <?php } ?>

    <?php if($linha > 0){ ?>
        <h2>Produtos Em Destaques</h2>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-1">
            <?php foreach($produtos as $prod): ?>
                <div class="col-sm-4 col-md-4 mb-4">
                    <div class="card h-100 shadow-sm rounded">
                        <img src="../../images/<?=$prod['imagem_principal']?>"
                             alt="<?=$prod['nome']?>"
                             class="card-img-top w-100"
                             style="object-fit: cover; height: 250px; transition: transform 0.3s;"
                             onmouseover="this.style.transform='scale(1.05)';"
                             onmouseout="this.style.transform='scale(1)';">
                        <div class="card-body text-white">
                            <h3 class="text-center text-white fw-bold mb-1">
                                <strong><i><?=$prod['nome']?></i></strong>
                            </h3>
                            <p class="card-text text-start">
                                <?=mb_strimwidth($prod['descricao_curta'],0,42,'...') ?>
                            </p>
                            <button class="btn btn-default disabled" role="button" style="cursor: default;">
                                <?="R$ ".number_format($prod['valor_base'],2,',','.')?>
                            </button>
                            <a href="../clientes/pagina_produto.php?id=<?= $prod['id']?>" class="btn btn-terciary float-end">
                                <span class="d-nome d-sm-inline">Saiba mais</span>
                                <i class="bi bi-eye-fill"></i>
                            </a>
                        </div> <!-- fecha card-body -->
                    </div> <!-- fecha card -->
                </div> <!-- fecha coluna -->
            <?php endforeach; ?>
        </div> <!-- fecha row -->
    <?php } ?>
</section>

    <!-- RODAPÉ -->
    <footer class="text-white p-4 mt-5">
    <?php include "../menu_publico/rodape.php"?> 
    </footer>

    <!-- Bootstrap JS + Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

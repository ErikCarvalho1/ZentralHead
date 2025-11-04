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
    <?php if($linha == 0){ ?>
        <h2 class="alert alert-danger">Não há produtos em destaques</h2>
    <?php } ?>

    <?php if($linha > 0){ ?>
        <h2>Produtos Em Destaques</h2>

        <div id="carouselProdutos" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php 
                    $active = "active";
                    $grupos = array_chunk($produtos, 4); // mostra 4 produtos por slide
                    foreach($grupos as $grupo):
                ?>
                    <div class="carousel-item <?= $active ?>">
                        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-1">
                            <?php foreach($grupo as $prod): ?>
                                <div class="mt-3 p-1 col-sm-2 col-md-3 mb-5">
                                    <div class="card h-100 shadow-sm"
                                        onmouseover="this.style.transform='scale(1.05)';"
                                        onmouseout="this.style.transform='scale(1)';">
                                        
                                        <div style="position: relative;">
    <img src="../../images/<?=$prod['imagem_principal']?>"
         alt="<?=$prod['nome']?>"
         class="card-img-top w-100"
         style="object-fit: cover; height: 200px; transition: transform 0.3s;">

    <?php if (!empty($prod['desconto_tipo']) && !empty($prod['desconto_valor'])): ?>
        <small class="text-danger bg-white px-2 py-1 rounded"
               style="position: absolute; top: 10px; left: 10px; font-weight: bold;">
            <?= ($prod['desconto_tipo'] === 'percentual')
                ? "-".$prod['desconto_valor']."% OFF"
                : "-R$ ".number_format($prod['desconto_valor'], 2, ',', '.') ?>
        </small>
    <?php endif; ?>
</div>


                                        
                                        <div class="card-body text-white">
                                            <h3 class="text-center text-white fw-bold mb-0">
                                                <strong><i><?=$prod['nome']?></i></strong>
                                            </h3>
                                            <p class="card-text text-start">
                                                <?=mb_strimwidth($prod['descricao_curta'],0,42,'...') ?>
                                            </p>
                                            <button class="btn btn-default disabled" role="button" style="cursor: default;">
                                                <?="R$ ".number_format($prod['valor_base'],2,',','.')?>
                                            </button>
                                            <a href="../clientes/pagina_produto.php?id=<?= $prod['id'] ?>" 
                                       class="btn  mt-2">
                                        Saiba mais <i class="bi bi-eye-fill"></i>
                                    </a>
                                        </div> <!-- fecha card-body -->
                                    </div> <!-- fecha card -->
                                </div> <!-- fecha coluna -->
                            <?php endforeach; ?>
                        </div> <!-- fecha row -->
                    </div> <!-- fecha carousel-item -->
                <?php 
                    $active = ""; // só o primeiro fica ativo
                    endforeach; 
                ?>
            </div> <!-- fecha carousel-inner -->

            <!-- Botões de navegação -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselProdutos" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselProdutos" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div> <!-- fecha carousel -->
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

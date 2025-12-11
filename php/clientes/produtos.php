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
    <link rel="stylesheet" href="../../css/card-produto.css" />

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
        <h2 class="text-center">Produtos Zentral</h2>

        <div id="carouselProdutos" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

            <?php 
            $active = "active";
            // Quebra o array de produtos em grupos de 4 por slide
            $grupos = array_chunk($produtos, 4);
            foreach($grupos as $grupo):
            ?>
            
            <div class="carousel-item my-4 mt-5 pt-3 <?= $active ?>">
                <?php $active = ""; ?>

                <div class="row justify-content-center">
                    <?php foreach($grupo as $prod): ?>
                        <?php
                        // Cálculo do preço final considerando desconto
                        $precoOriginal = $prod['valor_base'];
                        $precoFinal = $precoOriginal;

                        if (!empty($prod['desconto_tipo']) && $prod['desconto_valor'] > 0) {
                            if ($prod['desconto_tipo'] === 'percentual') {
                                $precoFinal = $precoOriginal - ($precoOriginal * $prod['desconto_valor'] / 100);
                            } elseif ($prod['desconto_tipo'] === 'fixo') {
                                $precoFinal = $precoOriginal - $prod['desconto_valor'];
                            }
                        }
                        ?>
                       <div class="col-12 col-sm-6 col-md-3 mb-2 d-flex justify-content-center">
                            <div class="card h-100 shadow-sm">
                                    <div class="card-img-container img-fluid" >
                                        <img src="../../images/<?= $prod['imagem_principal'] ?>"
                                             alt="<
                                             class="card-img-top w-100 h-100"
                                            >
                                    </div>

                                    <div class="card-body text-center">
                                        <h5 class="card-title text-black">
                                            <strong><?= $prod['nome'] ?></strong>
                                        </h5>

                                        <p class="card-text text-muted">
                                            <?= mb_strimwidth($prod['descricao_curta'], 0, 42, '...') ?>
                                        </p>

                                        <div class="mt-3">
                                            <?php if ($precoFinal < $precoOriginal): ?>
                                                <div>
                                                    <span class="text-muted text-decoration-line-through">
                                                        <?= "R$ ".number_format($precoOriginal, 2, ',', '.') ?>
                                                    </span>
                                                    <br>
                                                    <button class="btn btn-success disabled">
                                                        <?= "R$ ".number_format($precoFinal, 2, ',', '.') ?>
                                                    </button>
                                                    <br>
                                                    <small class="text-danger">
                                                        <?= ($prod['desconto_tipo'] === 'percentual')
                                                            ? "-".$prod['desconto_valor']."% OFF"
                                                            : "-R$ ".number_format($prod['desconto_valor'], 2, ',', '.') ?>
                                                    </small>
                                                </div>
                                            <?php else: ?>
                                                <button class="btn btn-secondary disabled">
                                                    <?= "R$ ".number_format($precoOriginal, 2, ',', '.') ?>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                     
                                        <a href="../clientes/pagina_produto.php?id=<?= $prod['id'] ?>" 
                                           class="btn btn-primary mt-2">
                                            Saiba mais <i class="bi bi-eye-fill"></i>
                                        </a>
                                    </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>

        </div>

            <!-- Botões de navegação -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselProdutos" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselProdutos" data-bs-slide="next">
 ?= htmlspecialchars($prod['nome']) ?>"               <span class="carousel-control-next-icon"></span>
            </button>
        </div> <!-- fecha carousel -->
    <?php } ?>
</section>

    <!-- RODAPÉ -->
    <footer>
    <?php include "../menu_publico/rodape.php"?> 
    </footer>

    <!-- Bootstrap JS + Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
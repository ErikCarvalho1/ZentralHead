<?php

include "../class/categorias.php";
$catClass = new catergorias();
$categorias = $catClass->listar();
?>

<section class="my-5">
    <h2 class="text-center mb-4">Categorias</h2>
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php 
            $active = "active";
            $grupos = array_chunk($categorias, 3);
            foreach($grupos as $grupo):
            ?>
            <div class="carousel-item <?= $active ?>">
                <?php $active = ""; ?>
                <div class="row">
                    <?php foreach($grupo as $cat): ?>
                    <div class="col-md-4">
                        <div class="card">
                            <a href="catalogo.php?categoria=<?= urlencode($cat['nome']) ?>" 
                               class="text-decoration-none">
                                <div class="d-flex justify-content-center mb-3 p-4">
                                    <img src="../../images/LogoZentral.png" class="img-fluid" 
                                         style="max-height: 200px; object-fit: contain;">
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?= htmlspecialchars($cat['nome']) ?></h5>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</section>

<?php
// filepath: c:\xampp\htdocs\ZentralHead\php\menu_publico\produtos-por-categoria.php
include_once "../class/produtos.php";

$categoria = $_GET['categoria'] ?? 'Todos';
$prod = new Produtos();
$produtos = $prod->listarPorNomeCategoria($categoria);
$linha = count($produtos);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - <?= htmlspecialchars($categoria) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    <?php include "cabecalho.php"; ?>

    <main class="container my-5">
        <h2 class="mb-4">Produtos - <?= htmlspecialchars($categoria) ?></h2>

        <?php if($linha == 0): ?>
            <div class="alert alert-info text-center">
                Nenhum produto encontrado nesta categoria.
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach($produtos as $prod): ?>
                    <?php
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
                    <div class="col-md-4 mb-4">
                        <a href="../clientes/pagina_produto.php?id=<?= $prod['id'] ?>" class="text-decoration-none">
                            <div class="card h-100 shadow-sm" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                <img src="../../images/<?= htmlspecialchars($prod['imagem_principal']) ?>" 
                                     class="card-img-top" style="object-fit: contain; height: 300px;">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?= htmlspecialchars($prod['nome']) ?></h5>
                                    <p class="text-muted"><?= mb_strimwidth($prod['descricao_curta'], 0, 50, '...') ?></p>
                                    <div class="mt-3">
                                        <?php if ($precoFinal < $precoOriginal): ?>
                                            <span class="text-decoration-line-through text-muted">
                                                R$ <?= number_format($precoOriginal, 2, ',', '.') ?>
                                            </span><br>
                                            <strong class="text-success">
                                                R$ <?= number_format($precoFinal, 2, ',', '.') ?>
                                            </strong><br>
                                            <small class="text-danger">
                                                <?= ($prod['desconto_tipo'] === 'percentual')
                                                    ? "-".$prod['desconto_valor']."% OFF"
                                                    : "-R$ ".number_format($prod['desconto_valor'], 2, ',', '.') ?>
                                            </small>
                                        <?php else: ?>
                                            <strong class="text-success">
                                                R$ <?= number_format($precoOriginal, 2, ',', '.') ?>
                                            </strong>
                                        <?php endif; ?>
                                        <br>
                                        <button class="btn btn-primary btn-sm mt-2 add-to-cart"
                                            data-id="<?= $prod['id'] ?>"
                                            data-nome="<?= htmlspecialchars($prod['nome']) ?>"
                                            data-preco="<?= $precoFinal ?>"
                                            data-img="<?= $prod['imagem_principal'] ?>">
                                            <i class="bi bi-cart3"></i> Carrinho
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <?php include "rodape.php"; ?>

    <script src="../../js/carrinho.js" defer></script>
</body>
</html>
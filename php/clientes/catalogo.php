<?php
include "../class/produtos.php";
include "../class/categorias.php";

$produto = new Produtos();
$catClass = new categorias();

// Pega a categoria da URL
$categoriaId = isset($_GET['categoria_id']) ? intval($_GET['categoria_id']) : 0;

// Busca produtos da categoria
if ($categoriaId > 0) {
    $produtos = $produto->listarPorCategoriaId($categoriaId);
    $categoria = $catClass->listarPorId($categoriaId); // pega a categoria
} else {
    $produtos = $produto->listar();
    $categoria = null;
}

$linha = count($produtos);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo - <?= htmlspecialchars($categoriaid) ?></title> <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- CSS do Catálogo -->
    <link rel="stylesheet" href="../../css/catalogo-produtos.css">
</head>

<body> <?php include "cabecalho.php"; ?>
<?php if ($categoria): ?>
<div class="banner-categoria">
    <img src="../../images/<?= htmlspecialchars($categoria['banner']) ?>" alt="<?= htmlspecialchars($categoria['nome']) ?>">
</div>
<?php endif; ?>

    <main class="container my-4">
        <!-- ===== PRODUTOS ===== --> <?php if ($linha == 0): ?> <div class="alert alert-warning text-center"> Nenhum
            produto encontrado nesta categoria. </div> <?php else: ?> <div class="row g-4">
            <?php foreach ($produtos as $prod): ?>
            <?php $precoOriginal = $prod['valor_base']; $precoFinal = $precoOriginal; if (!empty($prod['desconto_tipo']) && $prod['desconto_valor'] > 0) { if ($prod['desconto_tipo'] === 'percentual') { $precoFinal -= ($precoOriginal * $prod['desconto_valor'] / 100); } elseif ($prod['desconto_tipo'] === 'fixo') { $precoFinal -= $prod['desconto_valor']; } } ?>
            <div class="col-sm-6 col-md-4 col-lg-3"> <a href="../clientes/pagina_produto.php?id=<?= $prod['id'] ?>"
                    class="text-decoration-none text-dark">
                    <div class="card product-card h-100 position-relative"> <?php if ($precoFinal < $precoOriginal): ?>
                        <span class="badge bg-danger badge-discount">
                            <?= ($prod['desconto_tipo'] === 'percentual') ? "-{$prod['desconto_valor']}%" : "-R$ " . number_format($prod['desconto_valor'], 2, ',', '.') ?>
                        </span> <?php endif; ?> <img
                            src="../../images/<?= htmlspecialchars($prod['imagem_principal']) ?>"
                            class="card-img-top product-img" alt="<?= htmlspecialchars($prod['nome']) ?>">
                        <div class="card-body text-center">
                            <h6 class="fw-semibold"><?= htmlspecialchars($prod['nome']) ?></h6>
                            <p class="text-muted small"> <?= mb_strimwidth($prod['descricao_curta'], 0, 55, '...') ?>
                            </p> <?php if ($precoFinal < $precoOriginal): ?> <div class="price-original"> R$
                                <?= number_format($precoOriginal, 2, ',', '.') ?> </div> <?php endif; ?> <div
                                class="price-final"> R$ <?= number_format($precoFinal, 2, ',', '.') ?> </div> <button
                                class="btn  btn-sm mt-3 btn-cart add-to-cart" data-id="<?= $prod['id'] ?>"
                                data-nome="<?= htmlspecialchars($prod['nome']) ?>" data-preco="<?= $precoFinal ?>"
                                data-img="<?= $prod['imagem_principal'] ?>"> <i class="bi bi-cart3"></i> Adicionar
                            </button>
                        </div>
                    </div>
                </a> </div> <?php endforeach; ?> </div> <?php endif; ?>
    </main> <?php include "../menu_publico/rodape.php"; ?> <script src="../../js/carrinho.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
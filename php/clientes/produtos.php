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
<section class="container my-5">

<?php if ($linha == 0): ?>
    <div class="alert alert-danger text-center">
        Não há produtos em destaque
    </div>
<?php else: ?>

    <h2 class="text-center fw-semibold mb-4">Produtos Zentral</h2>

    <div class="row g-4">

    <?php foreach ($produtos as $prod): ?>
        <?php
        $precoOriginal = $prod['valor_base'];
        $precoFinal = $precoOriginal;

        if (!empty($prod['desconto_tipo']) && $prod['desconto_valor'] > 0) {
            if ($prod['desconto_tipo'] === 'percentual') {
                $precoFinal -= ($precoOriginal * $prod['desconto_valor'] / 100);
            } elseif ($prod['desconto_tipo'] === 'fixo') {
                $precoFinal -= $prod['desconto_valor'];
            }
        }
        ?>

        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <a href="../clientes/pagina_produto.php?id=<?= $prod['id'] ?>" class="text-decoration-none text-dark">

                <div class="card product-card h-100 position-relative">

                    <?php if ($precoFinal < $precoOriginal): ?>
                        <span class="badge bg-danger badge-discount">
                            <?= ($prod['desconto_tipo'] === 'percentual')
                                ? "-{$prod['desconto_valor']}%"
                                : "-R$ " . number_format($prod['desconto_valor'], 2, ',', '.') ?>
                        </span>
                    <?php endif; ?>

                    <!-- IMAGEM -->
                   
                        <img src="../../images/<?= htmlspecialchars($prod['imagem_principal']) ?>"
                             class="product-img"
                             alt="<?= htmlspecialchars($prod['nome']) ?>">
               

                    <!-- CORPO -->
                    <div class="card-body text-center">
                        <h6 class="fw-semibold"><?= htmlspecialchars($prod['nome']) ?></h6>

                        <p class="text-muted small">
                            <?= mb_strimwidth($prod['descricao_curta'], 0, 55, '...') ?>
                        </p>

                        <?php if ($precoFinal < $precoOriginal): ?>
                            <div class="price-original">
                                R$ <?= number_format($precoOriginal, 2, ',', '.') ?>
                            </div>
                        <?php endif; ?>

                        <div class="price-final">
                            R$ <?= number_format($precoFinal, 2, ',', '.') ?>
                        </div>

                        <span class="btn btn-outline-primary btn-sm mt-3">
                            Ver produto <i class="bi bi-eye-fill"></i>
                        </span>
                    </div>

                </div>

            </a>
        </div>

    <?php endforeach; ?>
    </div>

<?php endif; ?>
</section>


    <!-- RODAPÉ -->
    <footer>
    <?php include "../menu_publico/rodape.php"?> 
    </footer>

    <!-- Bootstrap JS + Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
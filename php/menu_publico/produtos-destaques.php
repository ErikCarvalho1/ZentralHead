<?php 
include "../class/produtos.php";
$produto = new Produtos();
$produtos = $produto->listarDestaques(1); 

$linha = count($produtos);
?>

<section class="my-5 container">

<?php if($linha == 0){ ?>
    <h2 class="alert alert-danger text-center">Não há produtos em destaques</h2>
<?php } ?>

<?php if($linha > 0){ ?>
    <h2 class="text-center mb-4">Produtos em Destaque</h2>

    <div id="carouselProdutos" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

            <?php 
            $active = "active";
            // Quebra o array de produtos em grupos de 4 por slide
            $grupos = array_chunk($produtos, 4);
            foreach($grupos as $grupo):
            ?>
            
            <div class="carousel-item <?= $active ?>">
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

                        <div class="col-12 col-sm-6 col-md-3 mb-4 d-flex justify-content-center">
                            <div class="card h-100" style="width: 16rem;">
                                <div class="card-img-container img-fluid" style="max-width: 100%; overflow:height: auto;">
                                    <img src="../../images/<?= $prod['imagem_principal'] ?>"
                                        alt="<?= $prod['nome'] ?>"
                                        class="card-img-top w-100 h-100"
                                        style="object-fit: contain;">
                                </div>

                                <div class="card-body text-center">
                                    <h5 class="card-title text-danger">
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

        <!-- Controles -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselProdutos" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#carouselProdutos" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>

        <!-- Indicadores -->
        <div class="carousel-indicators mt-3">
            <?php for($i=0; $i<count($grupos); $i++): ?>
                <button type="button" data-bs-target="#carouselProdutos" data-bs-slide-to="<?= $i ?>" class="<?= ($i==0?'active':'') ?>"></button>
            <?php endfor; ?>
        </div>
    </div>

<?php } ?>

</section>

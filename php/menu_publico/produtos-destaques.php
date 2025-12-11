<link rel="stylesheet" href="../../css/card-produto-destaque.css">


<?php 
include "../class/produtos.php";
$produto = new Produtos();
$produtos = $produto->listarDestaques(1); 

$linha = count($produtos);
?>

<section class="container my-4">
    <?php if($linha == 0){ ?>
        <h2 class="alert alert-danger">Não há produtos em destaques</h2>
    <?php } ?>

    <?php if($linha > 0){ ?>
        <h2 class="text-center"> Produtos Zentral</h2>

        <div id="carouselProdutos" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

            <?php 
            $active = "active";
            // Quebra o array de produtos em grupos de 4 por slide
            $grupos = array_chunk($produtos, 10);
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
                                             alt="<?= htmlspecialchars($prod['nome']) ?>"
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

    <?php } ?>
</section>
<script>
document.addEventListener('DOMContentLoaded', function() {
    function atualizarCarrinho() {
        const carrinho = JSON.parse(localStorage.getItem('carrinho') || '[]');
        const lista = document.getElementById('carrinho-lista');
        const totalSpan = document.getElementById('carrinho-total');
        lista.innerHTML = '';
        let total = 0;
        carrinho.forEach(item => {
            total += item.preco * item.qtd;
            const li = document.createElement('li');
            li.innerHTML = `<img src="../../images/${item.img}" width="32" height="32"> 
                ${item.nome} x${item.qtd} - R$ ${item.preco.toLocaleString('pt-BR', {minimumFractionDigits:2})}`;
            lista.appendChild(li);
        });
        totalSpan.textContent = total.toLocaleString('pt-BR', {minimumFractionDigits:2});
    }

    document.querySelectorAll('.add-to-cart').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const id = this.dataset.id;
            const nome = this.dataset.nome;
            const preco = parseFloat(this.dataset.preco);
            const img = this.dataset.img;
            let carrinho = JSON.parse(localStorage.getItem('carrinho') || '[]');
            const idx = carrinho.findIndex(item => item.id == id);
            if (idx > -1) {
                carrinho[idx].qtd += 1;
            } else {
                carrinho.push({id, nome, preco, img, qtd: 1});
            }
            localStorage.setItem('carrinho', JSON.stringify(carrinho));
            atualizarCarrinho();

            // Redireciona para a página de carrinho em clientes (mostra o carrinho atualizado)
            window.location.href = '../clientes/carrinho.php';
        });
    });

    atualizarCarrinho();
});
</script>

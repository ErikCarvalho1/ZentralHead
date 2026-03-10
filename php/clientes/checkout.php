<?php
session_start();

// Carregar configuração do Mercado Pago (define MP_PUBLIC_KEY)
require_once __DIR__ . '/../config/mercadopago.php';

if (
    !isset($_SESSION['carrinho']) ||
    !is_array($_SESSION['carrinho']) ||
    count($_SESSION['carrinho']) === 0
) {
    echo "<div style='padding:40px;text-align:center'>";
    echo "<h2>Carrinho vazio</h2>";
    echo "<a href='/ZentralHead/index.php'>Voltar à loja</a>";
    echo "</div>";
    exit;
}

$total = 0;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h2 class="mb-4"><i class="bi bi-bag-check"></i> Finalizar Compra</h2>

            <!-- RESUMO DO PEDIDO -->
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="bi bi-box"></i> Resumo do Pedido</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Produto</th>
                                    <th width="80" class="text-center">Qtd</th>
                                    <th width="100" class="text-end">Preço</th>
                                    <th width="100" class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($_SESSION['carrinho'] as $item): 
                                $subtotal = $item['preco'] * $item['qtd'];
                                $total += $subtotal;
                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($item['nome']) ?></td>
                                    <td class="text-center"><?= (int)$item['qtd'] ?></td>
                                    <td class="text-end">R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
                                    <td class="text-end fw-bold">R$ <?= number_format($subtotal, 2, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="border-top pt-3 mt-3">
                        <div class="d-flex justify-content-between">
                            <h6>Total:</h6>
                            <h6 class="fw-bold text-primary">R$ <?= number_format($total, 2, ',', '.') ?></h6>
                        </div>
                    </div>
                </div>
            </div>

            <form id="form-checkout" method="post" action="processa_checkout.php">
                <input type="hidden" name="total" value="<?= $total ?>">
                <input type="hidden" name="token" id="card_token">
                <input type="hidden" name="payment_method_id" id="payment_method_id">

                <!-- ENDEREÇO -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-geo-alt"></i> Endereço de Entrega</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label class="form-label">Rua</label>
                                <input class="form-control" name="rua" placeholder="Rua" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Número</label>
                                <input class="form-control" name="numero" placeholder="Número" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Bairro</label>
                            <input class="form-control" name="bairro" placeholder="Bairro" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Cidade</label>
                                <input class="form-control" name="cidade" placeholder="Cidade" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Estado</label>
                                <input class="form-control" name="estado" placeholder="SP" maxlength="2" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">CEP</label>
                                <input class="form-control" name="cep" placeholder="12345-678" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CONTATO -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-envelope"></i> Dados de Contato</h5>
                    </div>
                    <div class="card-body">
                        <label class="form-label">E-mail</label>
                        <input class="form-control" type="email" name="email" placeholder="seu.email@exemplo.com" required>
                    </div>
                </div>

                <!-- PAGAMENTO -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-credit-card"></i> Forma de Pagamento</h5>
                    </div>
                    <div class="card-body">
                        <select id="forma_pagamento" name="forma_pagamento" class="form-select" required>
                            <option value="">Selecione o método de pagamento</option>
                            <option value="pix">PIX</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-success btn-lg w-100">
                    <i class="bi bi-check-circle"></i> Finalizar Pedido
                </button>
            </form>
        </div>
    </div>
</div>

<?php if(defined('MP_PUBLIC_KEY') && MP_PUBLIC_KEY): ?>
    <script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
    <script>
        Mercadopago.setPublishableKey('<?= MP_PUBLIC_KEY ?>');
    </script>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

</body>
</html>

<?php
session_start();

/* 🔒 Segurança: carrinho precisa existir */
if (!isset($_SESSION['carrinho']) || !is_array($_SESSION['carrinho']) || count($_SESSION['carrinho']) === 0) {
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
    <title>Checkout</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5 mb-5">
    <h2 class="mb-4">Finalizar Compra</h2>

    <!-- RESUMO DO PEDIDO -->
    <h4>Resumo do Pedido</h4>

    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>Produto</th>
                <th width="80">Qtd</th>
                <th width="120">Preço</th>
                <th width="120">Subtotal</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($_SESSION['carrinho'] as $item): 
            $subtotal = $item['preco'] * $item['qtd'];
            $total += $subtotal;
        ?>
            <tr>
                <td><?= htmlspecialchars($item['nome']) ?></td>
                <td><?= (int)$item['qtd'] ?></td>
                <td>R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
                <td>R$ <?= number_format($subtotal, 2, ',', '.') ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot class="table-light">
            <tr>
                <th colspan="3" class="text-end">Total</th>
                <th>R$ <?= number_format($total, 2, ',', '.') ?></th>
            </tr>
        </tfoot>
    </table>

    <!-- FORMULÁRIO -->
    <form method="post" action="processa_checkout.php">

        <input type="hidden" name="total" value="<?= $total ?>">

        <!-- ENDEREÇO -->
        <h4 class="mt-4">Endereço de Entrega</h4>

        <div class="row">
            <div class="col-md-8">
                <input class="form-control mb-2" name="rua" placeholder="Rua" required>
            </div>
            <div class="col-md-4">
                <input class="form-control mb-2" name="numero" placeholder="Número" required>
            </div>
        </div>

        <input class="form-control mb-2" name="bairro" placeholder="Bairro" required>
        <input class="form-control mb-2" name="cidade" placeholder="Cidade" required>
        <input class="form-control mb-2" name="estado" placeholder="Estado" required>
        <input class="form-control mb-3" name="cep" placeholder="CEP" required>

        <!-- PAGAMENTO -->
        <h4>Pagamento</h4>

        <select name="forma_pagamento" class="form-control mb-4" required>
            <option value="">Selecione</option>
            <option value="pix">PIX</option>
            <option value="cartao">Cartão</option>
            <option value="boleto">Boleto</option>
        </select>

        <button class="btn btn-success btn-lg w-100">
            Finalizar Pedido
        </button>
    </form>
</div>

</body>
</html>

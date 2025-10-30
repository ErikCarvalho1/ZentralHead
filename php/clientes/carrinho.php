<?php
session_start();

$total = 0;
?>
<h3>Carrinho</h3>

<table class="table">
<tr>
    <th>Produto</th><th>Qtd</th><th>Preço</th><th>Total</th><th>Ações</th>
</tr>
<?php foreach($_SESSION['carrinho'] as $item): 
    $subtotal = $item['preco'] * $item['quantidade'];
    $total += $subtotal;
?>''
<tr>
    <td><?= $item['nome'] ?></td>
    <td><?= $item['quantidade'] ?></td>
    <td>R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
    <td>R$ <?= number_format($subtotal, 2, ',', '.') ?></td>
    <td><a href="remover.php?id=<?= $item['id'] ?>" class="btn btn-danger btn-sm">Remover</a></td>
</tr>
<?php endforeach; ?>
<tr>
    <td colspan="3" align="right"><b>Total:</b></td>
    <td><b>R$ <?= number_format($total, 2, ',', '.') ?></b></td>
</tr>
</table>

<a href="finalizar.php" class="btn btn-success">Finalizar Compra</a>
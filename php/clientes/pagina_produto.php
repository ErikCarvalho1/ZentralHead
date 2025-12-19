<?php require_once __DIR__ . '/../clientes/autenticacao.php';?>
<?php include "../class/produtos.php";?>
<?php 
if (!isset($_GET['id'])){
    die ("Produro não encontrado");
}

$id =(int) $_GET['id'];

$prod = new Produtos();
$produto = $prod->listarPorId($id);

if(!$produto){
    die("produto não encontrado");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script> 
    <link rel="stylesheet" href="../../css/pagina_produto.css">

  <title>Pagina Produto</title>

</head>
<body>
   <nav><?php include "cabecalho.php"; ?></nav> 
<main>

<div class="container mt-5">
  <div class="row align-items-start">
<!-- COLUNA ESQUERDA — IMAGENS DO PRODUTO -->
<div class="col-md-6">

  <!-- IMAGEM PRINCIPAL -->
  <img src="/ZentralHead/images/<?php echo $produto['imagem_principal']; ?>" 
       class="img-fluid"
       style="width:100%; max-width:450px; height:auto; border-radius:12px;">

  <!-- MINIATURAS -->
  <div class="d-flex gap-2 mt-3">
    <img src="/ZentralHead/images/<?php echo $produto['imagem_principal']; ?>" class="img-thumbnail" style="width:80px; height:80px; object-fit:cover;">
    <img src="/ZentralHead/images/<?php echo $produto['imagem_principal']; ?>" class="img-thumbnail" style="width:80px; height:80px; object-fit:cover;">
    <img src="/ZentralHead/images/<?php echo $produto['imagem_principal']; ?>" class="img-thumbnail" style="width:80px; height:80px; object-fit:cover;">
  </div>


</div>
<!-- FECHA COLUNA ESQUERDA -->


    <!-- COLUNA DIREITA — INFORMAÇÕES DO PRODUTO -->

    <div class="col-md-6">

      <h2 class="produto-titulo"><?php echo $produto['nome']; ?></h2>
      <h2 class="preco-produto"><?php echo $produto['valor_base']; ?></h2>

  
<!-- ESTRELAS-->

<div class="mt-2">
    <span class="text-dark">
      <i class="bi bi-star-fill"></i>
      <i class="bi bi-star-fill"></i>
      <i class="bi bi-star-fill"></i>
      <i class="bi bi-star-fill"></i>
      <i class="bi bi-star-fill"></i>
    </span>
    <span class="text-muted">(5,0) • 250 avaliações</span>
  </div>


      <p class="descricao-produto"><?php echo nl2br($produto['descricao']); ?></p>

      <?php

?>

<div class="d-flex gap-4 mb-3">
  <div>
    <label class="form-label fw-bold">Cor:</label><br>
    <?php if (!empty($cores)): ?>
        <?php foreach ($cores as $cor): ?>
            <button class="btn btn-outline-secondary btn-sm">
                <?php echo htmlspecialchars($cor['nome']); ?>
            </button>
        <?php endforeach; ?>
    <?php else: ?>
        <span class="text-muted">Nenhuma cor disponível</span>
    <?php endif; ?>
  </div>

  <div>
    <label class="form-label fw-bold">Tamanho:</label><br>
    <?php if (!empty($tamanhos)): ?>
        <?php foreach ($tamanhos as $tamanho): ?>
            <button class="btn btn-outline-secondary btn-sm">
                <?php echo htmlspecialchars($tamanho['nome']); ?>
            </button>
        <?php endforeach; ?>
    <?php else: ?>
        <span class="text-muted">Nenhum tamanho disponível</span>
    <?php endif; ?>
  </div>
</div>


      <!-- QUANTIDADE -->
      <div class="d-flex align-items-center mb-4">
          <label class="me-3 fw-bold">Quantidade:</label>
          <button class="btn btn-outline-secondary btn-sm" onclick="decrementQty()">-</button>
          <input type="text" id="qty" value="1" class="form-control text-center mx-2" style="width:60px;">
          <button class="btn btn-outline-secondary btn-sm" onclick="incrementQty()">+</button>
      </div>

      <!-- BOTÃO ADICIONAR AO CARRINHO -->
      <div class="d-flex gap-2">
          <button class="btn btn-dark" onclick="addToCart(<?php 
              echo htmlspecialchars(json_encode([
                  'id' => $produto['id'],
                  'nome' => $produto['nome'],
                  'preco' => floatval($produto['valor_base']),
                  'img' => $produto['imagem_principal']
              ])); 
          ?>)"> Adicionar ao carrinho </button>
      </div>
    </div> <!-- FECHA COLUNA DIREITA -->

  </div>
</div>

</main>
<hr>

<footer class="text-white p-4 mt-5">
    <?php include "../menu_publico/rodape.php"?> 
</footer>

</body>

</html>

<script>
function incrementQty() {
    const qtyInput = document.getElementById('qty');
    qtyInput.value = parseInt(qtyInput.value) + 1;
}

function decrementQty() {
    const qtyInput = document.getElementById('qty');
    const newValue = parseInt(qtyInput.value) - 1;
    qtyInput.value = newValue > 0 ? newValue : 1;
}

function addToCart(produto) {
    const qty = parseInt(document.getElementById('qty').value);

    if (qty < 1) {
        alert('Quantidade inválida');
        return;
    }

    let cart = JSON.parse(localStorage.getItem('carrinho') || '[]');
    const existingItem = cart.find(item => item.id === produto.id);

    if (existingItem) {
        existingItem.qtd += qty;
    } else {
        cart.push({ ...produto, qtd: qty });
    }

    localStorage.setItem('carrinho', JSON.stringify(cart));

    const cartCount = document.getElementById('cart-count');

    if (cartCount) {
        const totalItems = cart.reduce((acc, item) => acc + item.qtd, 0);
        cartCount.textContent = totalItems;
    }

    alert('Produto adicionado ao carrinho!');
}
</script>

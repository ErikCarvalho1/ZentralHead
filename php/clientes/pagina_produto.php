<?php require_once __DIR__ . '/../clientes/autenticacao.php';?>
<?php include "../class/produtos.php";

if (!isset($_GET['id'])){
    die ("Produro não encontrado");
}

$id =(int) $_GET['id'];

$prod = new produtos();
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

    <!-- ========================================================= -->
    <!-- COLUNA ESQUERDA — IMAGENS DO PRODUTO -->
    <!-- ========================================================= -->
    <div class="col-md-6">

        <!-- IMAGEM PRINCIPAL -->
        <img src="/ZentralHead/images/<?php echo $produto['imagem_principal']; ?>"  
             class="img-fluid"
             style="width:100%; max-width:450px; height:auto; border-radius:12px;">

        <!-- MINIATURAS -->
        <div class="d-flex gap-2 mt-3">
            <img src="/ZentralHead/images/<?php echo $produto['imagem_principal']; ?>"  
                 class="img-thumbnail"
                 style="width:80px; height:80px; object-fit:cover;">

            <img src="/ZentralHead/images/<?php echo $produto['imagem_principal']; ?>"  
                 class="img-thumbnail"
                 style="width:80px; height:80px; object-fit:cover;">

            <img src="/ZentralHead/images/<?php echo $produto['imagem_principal']; ?>"  
                 class="img-thumbnail"
                 style="width:80px; height:80px; object-fit:cover;">
        </div>

        <!-- BOTÃO VIEW MORE -->
        <div class="text-center mt-2">
            <button id="btnVerMais" class="btn btn-link">View more ↓</button>
        </div>

        <!-- FEATURES OCULTAS -->
        <div id="moreFeatures" class="p-3" style="display:none;">
            <ul>
                <li>Battery life up to 12 hours</li>
                <li>Bluetooth range of 30 feet</li>
                <li>Advanced microphone isolation</li>
            </ul>
        </div>

    </div> <!-- FECHA COLUNA ESQUERDA -->




    <!-- ========================================================= -->
    <!-- COLUNA DIREITA — INFORMAÇÕES DO PRODUTO -->
    <!-- ========================================================= -->
    <div class="col-md-6">

      <h2 class="produto-titulo"><?php echo $produto['nome']; ?></h2>
      <h2 class="preco-produto"><?php echo $produto['valor_base']; ?></h2>

      <!-- AVALIAÇÕES -->
      <?php
      $conn = getConnection();
      $sql = "SELECT AVG(nota) AS media, COUNT(*) AS total FROM avaliacoes WHERE produtos_id = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(1, $produto['id'], PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      $media = round($result['media'] ?? 0, 1);
      $total = $result['total'] ?? 0;
      ?>

      <div class="mb-2">
        <span class="text-warning">
          <?php
          $estrelasCheias = floor($media);
          $meia = ($media - $estrelasCheias >= 0.5);
          for ($i = 1; $i <= 5; $i++) {
              if ($i <= $estrelasCheias) echo "★";
              elseif ($meia && $i == $estrelasCheias + 1) echo "☆";
              else echo "☆";
          }
          ?>
        </span>
        <span class="text-muted">(<?php echo $media; ?>) • <?php echo $total; ?> avaliações</span>
      </div>

      <p class="descricao-produto"><?php echo nl2br($produto['descricao']); ?></p>


<!-- ================== CORES ===================== -->
<?php
$conn = getConnection();
$sql = "SELECT DISTINCT c.nome 
        FROM produto_detalhes pd
        JOIN cores c ON pd.cor_id = c.id
        WHERE pd.produto_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bindValue(1, $produto['id'], PDO::PARAM_INT);
$stmt->execute();
$cores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- ================== TAMANHOS ===================== -->
<?php
$sql = "SELECT DISTINCT t.nome 
        FROM produto_detalhes pd
        JOIN tamanhos t ON pd.tamanho_id = t.id
        WHERE pd.produto_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bindValue(1, $produto['id'], PDO::PARAM_INT);
$stmt->execute();
$tamanhos = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

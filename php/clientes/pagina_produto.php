<?php require_once __DIR__ . '/../clientes/autenticacao.php';?>
<?php include "../class/produtos.php";


if (!isset($_GET['id'])){     //!isset verifica se a variavel não existe
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
    <link rel="stylesheet" href="style.css">

  <title>Pagina Produto</title>

</head>
<body>
   <nav><?php include "cabecalho.php"; ?></nav> <main>

<div class="container mt-5">
  <div class="row">
    <!-- Coluna da imagem -->
    <div class="col-md-6">

    <img src="/ZentralHead/images/<?php echo $produto['imagem_principal']; ?>" style="width:350px; height:450px">
      <div class="d-flex gap-2 mt-2">
        <!-- Miniaturas (poderia vir do banco de dados futuramente) -->
        <img src="/ZentralHead/images/<?php echo $produto['imagem_principal']; ?>"  
        class="img-thumbnail"  
        style="width:80px; height:80px; object-fit:cover;">

        <img src="<?php echo $produto['imagem_principal']; ?>" class="img-thumbnail" style="width:80px; height:80px;">
        <img src="<?php echo $produto['imagem_principal']; ?>" class="img-thumbnail" style="width:80px; height:80px;">
      </div>
    </div>

    <!-- Coluna de informações -->
    <div class="col-md-6">
      <h4 class="text-muted"><?php echo $produto['categoria'] ?? "Produto em destaque"; ?></h4>
      <h2><?php echo $produto['nome']; ?></h2>





      
      <!-- Avaliações -->
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


      <!-- Preço -->
     
      <p class="text-muted"><?php echo $produto['valor_base']; ?></p>

      <?php
$conn = getConnection();

// Buscar cores disponíveis para o produto atual
$sql = "SELECT DISTINCT c.nome 
        FROM produto_detalhes pd
        JOIN cores c ON pd.cor_id = c.id
        WHERE pd.produto_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bindValue(1, $produto['id'], PDO::PARAM_INT);
$stmt->execute();
$cores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<?php
$conn = getConnection();

// Buscar tamanhos disponíveis para o produto atual
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
  <!-- Cores -->
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

  <!-- Tamanhos -->
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



      <!-- Quantidade -->
      <div class="d-flex align-items-center mb-4">
          <label class="me-3 fw-bold">Quantidade:</label>
          <button class="btn btn-outline-secondary btn-sm" onclick="decrementQty()">-</button>
          <input type="text" id="qty" value="1" class="form-control text-center mx-2" style="width:60px;">
          <button class="btn btn-outline-secondary btn-sm" onclick="incrementQty()">+</button>
      </div>

      <!-- Botões -->
      <div class="d-flex gap-2">
          <button class="btn btn-warning" onclick="addToCart(<?php 
              echo htmlspecialchars(json_encode([
                  'id' => $produto['id'],
                  'nome' => $produto['nome'],
                  'preco' => floatval($produto['valor_base']),
                  'img' => $produto['imagem_principal']
              ])); 
          ?>)"> Adicionar ao carrinho </button>
          <button class="btn btn-danger"> Comprar agora </button>
      </div>
    </div>
  </div>
</div>
</main>
<hr>
<!--Avaliações-->








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
        cart.push({
            ...produto,
            qtd: qty
        });
    }

    localStorage.setItem('carrinho', JSON.stringify(cart));
    
    // Atualiza o contador do carrinho
    const cartCount = document.getElementById('cart-count');
    const totalItems = cart.reduce((acc, item) => acc + item.qtd, 0);
    if (cartCount) cartCount.textContent = totalItems;

    alert('Produto adicionado ao carrinho!');
}
</script>



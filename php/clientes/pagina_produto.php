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

<div class="container mt-5">
  <div class="row">
    <!-- Coluna da imagem -->
    <div class="col-md-6">
      <img src="<?php echo $produto['imagem']; ?>" class="img-fluid rounded mb-3" alt="Imagem do produto">
      <div class="d-flex gap-2 mt-2">
        <!-- Miniaturas (poderia vir do banco de dados futuramente) -->
        <img src="<?php echo $produto['imagem']; ?>" class="img-thumbnail" style="width:80px; height:80px;">
        <img src="<?php echo $produto['imagem']; ?>" class="img-thumbnail" style="width:80px; height:80px;">
        <img src="<?php echo $produto['imagem']; ?>" class="img-thumbnail" style="width:80px; height:80px;">
      </div>
    </div>

    <!-- Coluna de informações -->
    <div class="col-md-6">
      <h4 class="text-muted"><?php echo $produto['categoria'] ?? "Produto em destaque"; ?></h4>
      <h2><?php echo $produto['nome']; ?></h2>

      <!-- Avaliações -->
      <div class="mb-2">
        <span class="text-warning"> ★★★★☆ </span>
        <span class="text-muted">(4.3) • 21,7 mil avaliações</span>
      </div>

      <!-- Preço -->
      <h3 class="text-success mb-3"> R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?> </h3>
      <p class="text-muted"><?php echo $produto['descricao']; ?></p>

      <!-- Modelos / tamanhos -->
      <div class="mb-3">
        <label class="form-label fw-bold">Modelo:</label><br>
        <button class="btn btn-outline-secondary btn-sm">1 Copo Azul</button>
        <button class="btn btn-outline-secondary btn-sm">1 Copo Rosa</button>
        <button class="btn btn-outline-secondary btn-sm">2 Copos Verde</button>
      </div>

      <!-- Quantidade -->
      <div class="d-flex align-items-center mb-4">
        <label class="me-3 fw-bold">Quantidade:</label>
        <button class="btn btn-outline-secondary btn-sm">-</button>
        <input type="text" value="1" class="form-control text-center mx-2" style="width:60px;">
        <button class="btn btn-outline-secondary btn-sm">+</button>
      </div>

      <!-- Botões -->
      <div class="d-flex gap-2">
        <button class="btn btn-warning"> 🛒 Adicionar ao carrinho </button>
        <button class="btn btn-danger"> Comprar agora </button>
      </div>
    </div>
  </div>
</div>



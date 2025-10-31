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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>pagina do produto</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
  </head>
  <bory>
  <?php include "cabecalho.php"; ?>

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
      <div class="mb-2">
        <span class="text-warning"> ★★★★☆ </span>
        <span class="text-muted">(4.3) • 21,7 mil avaliações</span>
      </div>

      <!-- Preço -->
     
      <p class="text-muted"><?php echo $produto['valor_base']; ?></p>

      <!-- Modelos / tamanhos -->
      <div class="mb-3">
        <label class="form-label fw-bold">Modelo:</label><br>
        <button class="btn btn-outline-secondary btn-sm">Azul</button>
        <button class="btn btn-outline-secondary btn-sm"> Bege</button>
        <button class="btn btn-outline-secondary btn-sm">Rosa</button>
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
        <button class="btn btn-warning"> Adicionar ao carrinho </button>
        <button class="btn btn-danger"> Comprar agora </button>
      </div>
    </div>
  </div>
</div>

 <?php include "../menu_publico/rodape.php"?> 

</body>
</html>



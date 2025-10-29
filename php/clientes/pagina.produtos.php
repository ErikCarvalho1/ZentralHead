<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- CABEÇALHO -->
    <header>
        <?php include_once "cabecalho.php"; ?>
    </header>

    <!-- CONTEÚDO -->
    <div class="container my-5">
        <h1 class="text-center mb-4">Produtos Zentral</h1>
        <div class="row">

            <!-- Produto 1 -->
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/200x300" class="card-img-top" alt="Produto 1">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Produto 1</h5>
                        <p class="card-text">Descrição breve do produto.</p>
                        <div class="mt-auto">
                            <p class="fw-bold">R$ 99,90</p>
                            <a href="#" class="btn btn-primary w-100">Comprar</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Produto 2 -->
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/200x150" class="card-img-top" alt="Produto 2">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Produto 2</h5>
                        <p class="card-text">Descrição breve do produto.</p>
                        <div class="mt-auto">
                            <p class="fw-bold">R$ 99,90</p>
                            <a href="#" class="btn btn-primary w-100">Comprar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="container-fluid text-white p-4 mt-5 bg-dark">
      <?php include_once "../menu_publico/rodape.php"?>
    </footer>
    <!-- Bootstrap JS + Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

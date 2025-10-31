<!DOCTYPE html>
<?php require_once __DIR__ . '/../clientes/autenticacao.php';?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Zentral</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
 <!-- Bootstrap Icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
   
    <!-- Bootstrap 5.3 -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <!-- CSS local -->
    <link rel="stylesheet" href="../../css/style.css" />
 
    <!-- js -->
    <script src="../../js/bootstrap.bundle.min.js" defer></script>
    <script src="../../js/inicial.js" defer></script>
</head>
<body>
    <!-- CABEÇALHO -->
    <header>
        <?php include_once "cabecalho.php"; ?>
    </header>

    <!-- CONTEÚDO -->
    <div class="container my-5">
        <h1 class="text-center mb-4">Camisas Zentral </h1>
        <div class="row g-4">

            <!-- Produto 1 -->
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm border-0">
                    <img src="https://via.placeholder.com/200x300" class="card-img-top" alt="Produto 1">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Produto 1</h5>
                        <p class="card-text flex-grow-1">Descrição breve do produto.</p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <span class="fw-bold">R$ 99,90</span>
                            <a href="#" class="btn btn-primary btn-sm">Comprar</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Produto 2 -->
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm border-0">
                    <img src="https://via.placeholder.com/200x300" class="card-img-top" alt="Produto 2">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Produto 2</h5>
                        <p class="card-text flex-grow-1">Descrição breve do produto.</p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <span class="fw-bold">R$ 99,90</span>
                            <a href="#" class="btn btn-primary btn-sm">Comprar</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Produto 3 -->
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm border-0">
                    <img src="https://via.placeholder.com/200x300" class="card-img-top" alt="Produto 3">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Produto 3</h5>
                        <p class="card-text flex-grow-1">Descrição breve do produto.</p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <span class="fw-bold">R$ 99,90</span>
                            <a href="#" class="btn btn-primary btn-sm">Comprar</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm border-0">
                    <img src="https://via.placeholder.com/200x300" class="card-img-top" alt="Produto 3">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Produto 4</h5>
                        <p class="card-text flex-grow-1">Descrição breve do produto.</p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <span class="fw-bold">R$ 99,90</span>
                            <a href="#" class="btn btn-primary btn-sm">Comprar</a>
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="text-center bg-4 ">Calças</h2>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm border-0">
                    <img src="https://via.placeholder.com/200x300" class="card-img-top" alt="Produto 3">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Produto 4</h5>
                        <p class="card-text flex-grow-1">Descrição breve do produto.</p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <span class="fw-bold">R$ 99,90</span>
                            <a href="#" class="btn btn-primary btn-sm">Comprar</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm border-0">
                    <img src="https://via.placeholder.com/200x300" class="card-img-top" alt="Produto 3">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Produto 4</h5>
                        <p class="card-text flex-grow-1">Descrição breve do produto.</p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <span class="fw-bold">R$ 99,90</span>
                            <a href="#" class="btn btn-primary btn-sm">Comprar</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm border-0">
                    <img src="https://via.placeholder.com/200x300" class="card-img-top" alt="Produto 3">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Produto 4</h5>
                        <p class="card-text flex-grow-1">Descrição breve do produto.</p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <span class="fw-bold">R$ 99,90</span>
                            <a href="#" class="btn btn-primary btn-sm">Comprar</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm border-0">
                    <img src="https://via.placeholder.com/200x300" class="card-img-top" alt="Produto 3">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Produto 4</h5>
                        <p class="card-text flex-grow-1">Descrição breve do produto.</p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <span class="fw-bold">R$ 99,90</span>
                            <a href="#" class="btn btn-primary btn-sm">Comprar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- RODAPÉ -->
    <footer class="text-white p-4 mt-5">
    <?php include "../menu_publico/rodape.php"?> 
    </footer>

    <!-- Bootstrap JS + Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

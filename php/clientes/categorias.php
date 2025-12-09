<?php
require_once __DIR__ . '/../clientes/autenticacao.php';
include "../class/categorias.php";
$catClass = new categorias();
$categorias = $catClass->listar();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias - ZentralHead</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="../../css/categorias.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    <?php include "cabecalho.php"; ?>

    <!-- Header da Página -->
    <div class="page-header ">
        <div class="  bg-olho  "> 
            
            <h1><i class="bi bi-tags"></i> Nossas Categorias</h1>
            <p>Explore todas as categorias de produtos disponíveis</p>
            
         
        </div>
    </div>

    <!-- Conteúdo Principal -->
    <main class="container my-5">
        <?php if(count($categorias) > 0): ?>
            <div class="row g-4">
                <?php foreach($categorias as $cat): ?>
                <div class="col-md-6 col-lg-4">
                    <a href="../clientes/catalogo.php?categoria=<?= urlencode($cat['nome']) ?>" 
                       class="categoria-link">
                        <div class="card categoria-card h-100">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center text-center py-5">
                                <div class="categoria-icon">
                                  <img  src="../../images/LogoZentral.png" alt="">  
                                </div>
                                <h5 class="categoria-title"><?= htmlspecialchars($cat['nome']) ?></h5>
                                <p class="categoria-count">
                                    <i class="bi bi-arrow-right-circle"></i> Explorar produtos
                                </p>
                                <button class="btn btn-primary btn-sm mt-3">
                                    <i class="bi bi-search"></i> Ver Catálogo
                                </button>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center" role="alert">
                <i class="bi bi-exclamation-triangle"></i>
                <strong>Nenhuma categoria disponível no momento.</strong>
            </div>
        <?php endif; ?>
    </main>

    <!-- Footer -->
    <?php include "../menu_publico/rodape.php"; ?>

    <script src="../../js/carrinho.js" defer></script>
</body>
</html>
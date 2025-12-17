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

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- CSS da página -->
    <link href="../../css/categorias.css" rel="stylesheet">
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
<?php include "../menu_publico/faixa.php"?>
<?php include "cabecalho.php"; ?>
<div class="page-header">

</div>
<!-- Conteúdo Principal -->
<main class="container my-5">
    <?php if(count($categorias) > 0): ?>
        <div class="row g-4">
            <?php foreach($categorias as $cat): ?>
                <div class="col-md-6 col-lg-4">
                    <a 
                        href="../clientes/catalogo.php?categoria_id=<?= $cat['id'] ?>" 
                        class="text-decoration-none"
                    >
                        <div class="card categoria-card h-100 overflow-hidden d-flex flex-column justify-content-end align-items-center text-center">

                            <!-- Imagem ocupando o card inteiro -->
                            <img 
                                src="../../images/<?= htmlspecialchars($cat['imagem']) ?>"  
                                alt="<?= htmlspecialchars($cat['nome']) ?>"
                                class="card-img-top categoria-img"
                            >
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($cat['nome']) ?></h5>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center">
            <i class="bi bi-exclamation-triangle"></i>
            Nenhuma categoria disponível no momento.
        </div>
    <?php endif; ?>
</main>

<?php include "../menu_publico/rodape.php"; ?>

</body>
</html>

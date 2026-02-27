<?php
session_start();

/* ==========================
   VALIDAÇÃO
========================== */
if (
    empty($_SESSION['pix_qr']) ||
    empty($_SESSION['pix_copia']) ||
    empty($_SESSION['pedido_id'])
) {
    echo "Pagamento PIX não encontrado.";
    exit;
}

$pedido_id = (int) $_SESSION['pedido_id'];
$qrBase64  = $_SESSION['pix_qr'];
$pixCopia = $_SESSION['pix_copia'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Aguardando Pagamento PIX</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <style>
        .pix-box {
            max-width: 420px;
            margin: auto;
            text-align: center;
        }
        .pix-code {
            font-size: 14px;
            word-break: break-all;
            background: #f8f9fa;
            padding: 10px;
            border-radius: 6px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="pix-box card shadow-sm p-4">

        <h4 class="mb-3">💸 Pagamento via PIX</h4>

        <p>
            Pedido <strong>#<?= $pedido_id ?></strong><br>
            Escaneie o QR Code ou copie o código abaixo
        </p>

        <!-- QR CODE -->
        <img
            src="data:image/png;base64,<?= $qrBase64 ?>"
            alt="QR Code PIX"
            class="img-fluid mb-3"
        >

        <!-- COPIA E COLA -->
        <div class="pix-code mb-3" id="pixCode">
            <?= htmlspecialchars($pixCopia) ?>
        </div>

        <button class="btn btn-outline-primary w-100 mb-3" onclick="copiarPix()">
            Copiar código PIX
        </button>

        <div id="status" class="alert alert-warning">
            ⏳ Aguardando confirmação do pagamento...
        </div>

        <a href="/ZentralHead/index.php" class="btn btn-link mt-3">
            Voltar à loja
        </a>
    </div>
</div>

<script>
function copiarPix() {
    const text = document.getElementById('pixCode').innerText;
    navigator.clipboard.writeText(text).then(() => {
        alert('Código PIX copiado!');
    });
}

/* ==========================
   VERIFICA STATUS (POLLING)
========================== */
setInterval(() => {
    fetch('../clientes/verifica_pagamento.php?pedido_id=<?= $pedido_id ?>')
        .then(res => res.json())
        .then(data => {
            if (data.status === 'pago') {
                document.getElementById('status').className = 'alert alert-success';
                document.getElementById('status').innerText = '✅ Pagamento confirmado!';
                setTimeout(() => {
                    window.location.href = 'pedido_sucesso.php?pedido_id=<?= $pedido_id ?>';
                }, 1500);
            }
        });
}, 5000);
</script>

</body>
</html>

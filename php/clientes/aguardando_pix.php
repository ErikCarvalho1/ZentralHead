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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aguardando Pagamento PIX</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
    <style>
        body { background-color: #f8f9fa; }
        .pix-container { max-width: 500px; margin: 40px auto; }
        .pix-card { border: none; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .pix-header { background-color: #7902e7ff; color: white; padding: 25px; border-radius: 12px 12px 0 0; text-align: center; }
        .pix-header h3 { font-size: 24px; margin: 0; font-weight: 600; }
        .pix-header p { margin: 10px 0 0 0; opacity: 0.9; }
        .qr-code-box { padding: 30px 20px; text-align: center; background: white; }
        .qr-code-box img { max-width: 100%; border-radius: 8px; border: 2px solid #e9ecef; }
        .pix-code-section { padding: 20px; background: #f8f9fa; border-top: 1px solid #dee2e6; }
        .pix-code { 
            background: white; 
            padding: 15px; 
            border-radius: 8px; 
            border: 2px dashed #601085ff; 
            font-family: monospace;
            font-size: 12px;
            word-break: break-all;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .pix-code:hover { background: #e8f5e9; }
        .btn-copy { background-color: #914fcaff; border: none; font-weight: 600; }
        .btn-copy:hover { background-color: #7812d8ff; }
        .status-box { padding: 20px; border-radius: 8px; margin: 15px 0; }
        .pedido-info { padding: 15px; background: #ebe3fdff; border-left: 4px solid #7700ffff; border-radius: 4px; margin-bottom: 15px; }
        .pedido-info h6 { color: #a200ffff; margin: 0 0 8px 0; }
        .pedido-info p { margin: 0; color: #555; }
    </style>    
</head>
<body>

<div class="pix-container">
    <div class="pix-card">
        <div class="pix-header">
            <h3><i class="bi bi-qr-code"></i> Pagamento via PIX</h3>
            <p>Escaneie ou copie o código para pagar</p>
        </div>

        <div class="card-body p-0">
            <!-- INFORMAÇÕES DO PEDIDO -->
            <div class="pedido-info mx-3 mt-3">
                <h6><i class="bi bi-bag-check"></i> Pedido #<?= $pedido_id ?></h6>
                <p>Seu pedido está aguardando confirmação do pagamento</p>
            </div>

            <!-- QR CODE -->
            <div class="qr-code-box">
                <img 
                    src="data:image/png;base64,<?= $qrBase64 ?>" 
                    alt="QR Code PIX"
                    class="img-fluid"
                >
                <p class="text-muted small mt-3">Aponte a câmera do seu celular para o QR Code</p>
            </div>

            <!-- COPIA E COLA -->
            <div class="pix-code-section">
                <p class="small text-muted mb-2"><strong>Ou copie este código:</strong></p>
                <div class="pix-code" id="pixCode" title="Clique para copiar">
                    <?= htmlspecialchars($pixCopia) ?>
                </div>
                <button class="btn btn-copy btn-sm w-100" onclick="copiarPix()">
                    <i class="bi bi-files"></i> Copiar código PIX
                </button>
            </div>

            <!-- STATUS -->
            <div class="status-box mx-3 my-3">
                <div id="status" class="alert alert-warning mb-0">
                    <i class="bi bi-hourglass-split"></i> Aguardando confirmação do pagamento...
                </div>
            </div>

            <!-- BOTÕES -->
            <div class="px-3 pb-3">
                <a href="index.php" class="btn btn-light btn-sm w-100">
                    <i class="bi bi-house"></i> Voltar à loja
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function copiarPix() {
    const text = document.getElementById('pixCode').innerText.trim();
    navigator.clipboard.writeText(text).then(() => {
        const btn = event.target.closest('button');
        const originalHTML = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-check-circle"></i> Copiado!';
        btn.classList.add('btn-success');
        btn.classList.remove('btn-copy');
        
        setTimeout(() => {
            btn.innerHTML = originalHTML;
            btn.classList.remove('btn-success');
            btn.classList.add('btn-copy');
        }, 2000);
    }).catch(err => {
        alert('Erro ao copiar: ' + err);
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
                document.getElementById('status').className = 'alert alert-success mb-0';
                document.getElementById('status').innerHTML = '<i class="bi bi-check-circle-fill"></i> Pagamento confirmado!';
                setTimeout(() => {
                    window.location.href = 'pedido_sucesso.php?pedido_id=<?= $pedido_id ?>';
                }, 2000);
            }
        })
        .catch(err => console.error('Erro ao verificar pagamento:', err));
}, 5000);
</script>
</body>
</html>
         
</script>

</body>
</html>

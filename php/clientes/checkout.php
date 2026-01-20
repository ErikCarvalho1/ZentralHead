<?php
session_start();

// Carregar configuração do Mercado Pago (define MP_PUBLIC_KEY)
require_once __DIR__ . '/../config/mercadopago.php';

if (
    !isset($_SESSION['carrinho']) ||
    !is_array($_SESSION['carrinho']) ||
    count($_SESSION['carrinho']) === 0
) {
    echo "<div style='padding:40px;text-align:center'>";
    echo "<h2>Carrinho vazio</h2>";
    echo "<a href='/ZentralHead/index.php'>Voltar à loja</a>";
    echo "</div>";
    exit;
}

$total = 0;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5 mb-5">
    <h2 class="mb-4">Finalizar Compra</h2>

    <h4>Resumo do Pedido</h4>

    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>Produto</th>
                <th width="80">Qtd</th>
                <th width="120">Preço</th>
                <th width="120">Subtotal</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($_SESSION['carrinho'] as $item): 
            $subtotal = $item['preco'] * $item['qtd'];
            $total += $subtotal;
        ?>
            <tr>
                <td><?= htmlspecialchars($item['nome']) ?></td>
                <td><?= (int)$item['qtd'] ?></td>
                <td>R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
                <td>R$ <?= number_format($subtotal, 2, ',', '.') ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot class="table-light">
            <tr>
                <th colspan="3" class="text-end">Total</th>
                <th>R$ <?= number_format($total, 2, ',', '.') ?></th>
            </tr>
        </tfoot>
    </table>

    <form id="form-checkout" method="post" action="processa_checkout.php">
        <input type="hidden" name="total" value="<?= $total ?>">
        <input type="hidden" name="token" id="card_token">
        <input type="hidden" name="payment_method_id" id="payment_method_id">

        <h4 class="mt-4">Endereço de Entrega</h4>

        <div class="row">
            <div class="col-md-8">
                <input class="form-control mb-2" name="rua" placeholder="Rua" required>
            </div>
            <div class="col-md-4">
                <input class="form-control mb-2" name="numero" placeholder="Número" required>
            </div>
        </div>

        <input class="form-control mb-2" name="bairro" placeholder="Bairro" required>
        <input class="form-control mb-2" name="cidade" placeholder="Cidade" required>
        <input class="form-control mb-2" name="estado" placeholder="Estado" required>
        <input class="form-control mb-3" name="cep" placeholder="CEP" required>

        <h4>Pagamento</h4>

        <select id="forma_pagamento" name="forma_pagamento" class="form-control mb-4" required>
            <option value="">Selecione</option>
            <option value="pix">PIX</option>
            <option value="cartao">Cartão</option>
            <option value="boleto">Boleto</option>
        </select>

        <!-- Campos do cartão (aparecem somente quando selecionar Cartão) -->
        <div id="cartao_fields" style="display:none;">
            <input class="form-control mb-2" id="card_number" placeholder="Número do cartão" maxlength="24">
            <input class="form-control mb-2" id="card_holder" placeholder="Nome (como no cartão)">
            <div class="row">
                <div class="col-md-4">
                    <input class="form-control mb-2" id="card_expiration" placeholder="MM/YY" maxlength="5">
                </div>
                <div class="col-md-4">
                    <input class="form-control mb-2" id="card_cvv" placeholder="CVV" maxlength="4">
                </div>
                <div class="col-md-4">
                    <input class="form-control mb-2" id="card_installments" placeholder="Parcelas" value="1">
                </div>
            </div>
            <input class="form-control mb-2" id="payer_email" name="email" placeholder="E-mail do pagador">
            <div class="row">
                <div class="col-md-6">
                    <input class="form-control mb-2" id="payer_doc" placeholder="CPF do pagador (somente números)" maxlength="14">
                </div>
                <div class="col-md-6">
                    <select class="form-control mb-2" id="payer_doc_type">
                        <option value="CPF">CPF</option>
                        <option value="CNPJ">CNPJ</option>
                    </select>
                </div>
            </div>
        </div>

        <button class="btn btn-success btn-lg w-100">
            Finalizar Pedido
        </button>
    </form>
</div>

<?php if(defined('MP_PUBLIC_KEY') && MP_PUBLIC_KEY): ?>
    <script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
    <script>
        Mercadopago.setPublishableKey('<?= MP_PUBLIC_KEY ?>');
    </script>
<?php else: ?>
    <!-- MP_PUBLIC_KEY não configurada. Configure em php/config/mercadopago.php -->
<?php endif; ?>

<script>
// Mostrar/ocultar campos do cartão
const select = document.getElementById('forma_pagamento');
const cardFields = document.getElementById('cartao_fields');
select.addEventListener('change', ()=>{
    if(select.value === 'cartao' || select.value === 'card') cardFields.style.display = '';
    else cardFields.style.display = 'none';
});

// Interceptar submit para tokenizar quando usar cartão
const form = document.getElementById('form-checkout');
form.addEventListener('submit', function(e){
    if (select.value !== 'cartao' && select.value !== 'card') return true;

    e.preventDefault();

    // Validação simples de e-mail
    const email = document.getElementById('payer_email').value.trim();
    if (!email || !/^[^@]+@[^@]+\.[^@]+$/.test(email)) {
        alert('E-mail inválido');
        return false;
    }

    // Garantir que a biblioteca do Mercado Pago esteja disponível
    if (typeof Mercadopago === 'undefined' || !Mercadopago.createToken) {
        alert('MercadoPago.js não carregado. Verifique MP_PUBLIC_KEY.');
        return false;
    }

    const cardNumber = document.getElementById('card_number').value.replace(/\s+/g, '');

    // Obter payment_method_id pelo BIN
    Mercadopago.getPaymentMethod({"bin": cardNumber.substring(0,6)}, function(status, response){
        if (status !== 200 && status !== 201) {
            console.error('Erro ao obter payment method:', status, response);
            alert('Não foi possível identificar a bandeira do cartão');
            return;
        }

        const paymentMethodId = (response && response[0] && response[0].id) ? response[0].id : null;
        if (!paymentMethodId) {
            console.error('Payment method não identificado:', response);
            alert('Não foi possível identificar a bandeira do cartão');
            return;
        }

        // Ler documento do pagador
        const idType = document.getElementById('payer_doc_type').value || 'CPF';
        const idNumber = (document.getElementById('payer_doc').value || '').replace(/\D/g, '');
        if (!idNumber) {
            alert('Informe o CPF/CNPJ do pagador');
            return;
        }

        // Criar token do cartão
        var tokenPayload = {
            cardNumber: cardNumber,
            cardholderName: document.getElementById('card_holder').value,
            cardExpirationMonth: (document.getElementById('card_expiration').value.split('/')[0]||'').replace(/[^0-9]/g,''),
            cardExpirationYear: (document.getElementById('card_expiration').value.split('/')[1]||'').replace(/[^0-9]/g,''),
            securityCode: document.getElementById('card_cvv').value,
            identificationType: idType,
            identificationNumber: idNumber,
            // Campos alternativos que algumas versões do SDK/API aceitam
            docType: idType,
            docNumber: idNumber
        };
        console.log('tokenPayload:', tokenPayload);
        Mercadopago.createToken(tokenPayload, function(status2, response2){
            console.log('createToken status:', status2, response2);
            if (status2 !== 200 && status2 !== 201) {
                var msg = 'Erro ao tokenizar o cartão.';
                try {
                    if (response2 && response2.cause && response2.cause.length) {
                        msg += '\n' + response2.cause.map(function(c){ return c.description || c.code || JSON.stringify(c); }).join('\n');
                    } else if (response2 && response2.message) {
                        msg += '\n' + response2.message;
                    } else {
                        msg += '\nCódigo: ' + status2;
                    }
                } catch(e) {}
                alert(msg);
                return;
            }

            const token = response2.id;
            document.getElementById('card_token').value = token;
            document.getElementById('payment_method_id').value = paymentMethodId;

            // Submeter o form com os campos ocultos preenchidos
            form.submit();
        });
    });
});
</script>

</body>
</html>

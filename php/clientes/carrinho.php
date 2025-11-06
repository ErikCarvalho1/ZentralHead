<?php
// ...existing code...
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Carrinho</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .cart-img { width:64px; height:64px; object-fit:contain; }
    </style>
</head>
<body>
<div class="container my-5">
    <h2 class="mb-4">Seu Carrinho</h2>

    <div id="cart-empty" class="alert alert-info" style="display:none;">
        Seu carrinho está vazio.
    </div>

    <div id="cart-list" class="list-group mb-3"></div>

    <div id="cart-summary" class="d-flex justify-content-between align-items-center mb-3" style="display:none;">
        <div>
            <button id="clear-cart" class="btn btn-outline-danger btn-sm">Limpar carrinho</button>
        </div>
        <div>
            <strong>Total: R$ <span id="cart-total">0,00</span></strong>
            <a href="../menu_publico/produtos-destaques.php" class="btn btn-secondary ms-3">Continuar comprando</a>
            <button id="checkout-btn" class="btn btn-success ms-3">Finalizar compra</button>
        </div>
    </div>

    <div id="cart-feedback"></div>
</div>

<script>
(function(){
    function formatPrice(v){
        return v.toLocaleString('pt-BR', {minimumFractionDigits:2, maximumFractionDigits:2});
    }

    function getCart(){
        return JSON.parse(localStorage.getItem('carrinho') || '[]');
    }

    function setCart(cart){
        localStorage.setItem('carrinho', JSON.stringify(cart));
        renderCart();
    }

    function renderCart(){
        const cart = getCart();
        const list = document.getElementById('cart-list');
        const empty = document.getElementById('cart-empty');
        const summary = document.getElementById('cart-summary');
        const totalSpan = document.getElementById('cart-total');

        list.innerHTML = '';
        if(!cart || cart.length === 0){
            empty.style.display = 'block';
            summary.style.display = 'none';
            return;
        }

        empty.style.display = 'none';
        summary.style.display = 'flex';

        let total = 0;
        cart.forEach(item => {
            total += item.preco * item.qtd;

            const row = document.createElement('div');
            row.className = 'list-group-item d-flex align-items-center';

            row.innerHTML = `
                <img src="../../images/${item.img}" class="cart-img me-3" alt="${escapeHtml(item.nome)}">
                <div class="me-auto">
                    <div><strong>${escapeHtml(item.nome)}</strong></div>
                    <div class="text-muted">R$ ${formatPrice(item.preco)} cada</div>
                </div>
                <div class="d-flex align-items-center">
                    <button class="btn btn-sm btn-outline-secondary me-2 qty-decrease" data-id="${item.id}">-</button>
                    <input type="number" min="1" class="form-control form-control-sm me-2 qty-input" data-id="${item.id}" value="${item.qtd}" style="width:72px;">
                    <div class="me-3">R$ <span class="item-subtotal">${formatPrice(item.preco * item.qtd)}</span></div>
                    <button class="btn btn-sm btn-danger remove-item" data-id="${item.id}">Remover</button>
                </div>
            `;
            list.appendChild(row);
        });

        totalSpan.textContent = formatPrice(total);

        document.querySelectorAll('.qty-decrease').forEach(btn=>{ btn.onclick = () => changeQty(btn.dataset.id, -1); });
        document.querySelectorAll('.qty-input').forEach(inp=>{ inp.onchange = () => setQty(inp.dataset.id, parseInt(inp.value) || 1); });
        document.querySelectorAll('.remove-item').forEach(btn=>{ btn.onclick = () => removeItem(btn.dataset.id); });
    }

    function changeQty(id, delta){
        const cart = getCart();
        const idx = cart.findIndex(i => i.id == id);
        if(idx === -1) return;
        cart[idx].qtd = Math.max(1, cart[idx].qtd + delta);
        setCart(cart);
    }

    function setQty(id, qty){
        const cart = getCart();
        const idx = cart.findIndex(i => i.id == id);
        if(idx === -1) return;
        cart[idx].qtd = Math.max(1, qty);
        setCart(cart);
    }

    function removeItem(id){
        let cart = getCart();
        cart = cart.filter(i => i.id != id);
        setCart(cart);
    }

    document.getElementById('clear-cart').addEventListener('click', function(){
        if(!confirm('Deseja limpar o carrinho?')) return;
        localStorage.removeItem('carrinho');
        renderCart();
    });

    document.getElementById('checkout-btn').addEventListener('click', function(){
        const cart = getCart();
        if(!cart.length){
            alert('Carrinho vazio');
            return;
        }
        // Aqui você pode enviar para o backend. Exemplo:
        // fetch('../clientes/checkout.php', { method:'POST', headers:{'Content-Type':'application/json'}, body:JSON.stringify({cart}) })
        //   .then(...)

        alert('Implementar checkout no servidor.');
    });

    function escapeHtml(text){
        return String(text).replace(/[&<>"'`=\/]/g, function(s) {
            return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;','/':'&#x2F;','`':'&#x60;','=':'&#x3D;'}[s];
        });
    }

    renderCart();
})();
</script>
</body>
</html>

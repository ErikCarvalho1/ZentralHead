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
        updateCartCount();
    }

    function updateCartCount() {
        const cart = getCart();
        const count = cart.reduce((acc, item) => acc + item.qtd, 0);
        document.getElementById('cart-count').textContent = count;
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
        summary.style.display = 'block';

        let total = 0;
        cart.forEach(item => {
            total += item.preco * item.qtd;

            const row = document.createElement('div');
            row.className = 'list-group-item';

            row.innerHTML = `
                <div class="d-flex align-items-center">
                    <img src="/ZentralHead/images/${item.img}" class="cart-img me-3" alt="${escapeHtml(item.nome)}">
                    <div class="flex-grow-1">
                        <div><strong>${escapeHtml(item.nome)}</strong></div>
                        <div class="text-muted">R$ ${formatPrice(item.preco)} cada</div>
                        <div class="d-flex align-items-center mt-2">
                            <button class="btn btn-sm btn-outline-secondary qty-decrease" data-id="${item.id}">-</button>
                            <input type="number" min="1" class="form-control form-control-sm mx-2 qty-input" 
                                   data-id="${item.id}" value="${item.qtd}" style="width:60px">
                            <button class="btn btn-sm btn-outline-secondary qty-increase" data-id="${item.id}">+</button>
                        </div>
                    </div>
                  
                </div>
            `;
            list.appendChild(row);
        });

        totalSpan.textContent = formatPrice(total);

        document.querySelectorAll('.qty-decrease').forEach(btn => { 
            btn.onclick = () => changeQty(btn.dataset.id, -1); 
        });
        document.querySelectorAll('.qty-increase').forEach(btn => { 
            btn.onclick = () => changeQty(btn.dataset.id, 1); 
        });
        document.querySelectorAll('.qty-input').forEach(inp => { 
            inp.onchange = () => setQty(inp.dataset.id, parseInt(inp.value) || 1); 
        });
        document.querySelectorAll('.remove-item').forEach(btn => { 
            btn.onclick = () => removeItem(btn.dataset.id); 
        });
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

    function escapeHtml(text){
        return String(text).replace(/[&<>"'`=\/]/g, function(s) {
            return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;','/':'&#x2F;','`':'&#x60;','=':'&#x3D;'}[s];
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('clear-cart').addEventListener('click', function(){
            if(!confirm('Tem certeza que deseja limpar o carrinho?')) return;
            localStorage.removeItem('carrinho');
            renderCart();
            updateCartCount();
        });

        document.getElementById('checkout-btn').addEventListener('click', function(){
            const cart = getCart();
            if(!cart.length){
                alert('Seu carrinho está vazio');
                return;
            }
            alert('Implementar checkout no servidor.');
        });

        renderCart();
        updateCartCount();
    });
})();
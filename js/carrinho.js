
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
        const el = document.getElementById('cart-count');
        if(el) el.textContent = count;
    }

    function renderCart(){
        const cart = getCart();
        const list = document.getElementById('cart-list');
        const empty = document.getElementById('cart-empty');
        const summary = document.getElementById('cart-summary');
        const totalSpan = document.getElementById('cart-total');

        if(!list) return;

        list.innerHTML = '';

        if(!cart.length){
            if(empty) empty.style.display = 'block';
            if(summary) summary.style.display = 'none';
            return;
        }

        if(empty) empty.style.display = 'none';
        if(summary) summary.style.display = 'block';

        let total = 0;

        cart.forEach(item => {
            total += item.preco * item.qtd;

            const row = document.createElement('div');
            row.className = 'list-group-item d-flex justify-content-between';

            row.innerHTML = `
                <div class="d-flex">
                    <img src="/ZentralHead/images/${item.img}" style="width:80px" class="me-3">
                    <div>
                        <strong>${escapeHtml(item.nome)}</strong><br>
                        Qtd: ${item.qtd}<br>
                        R$ ${formatPrice(item.preco)}
                    </div>
                </div>
                <button class="btn btn-sm btn-danger remove-item" data-id="${item.id}">×</button>
            `;

            list.appendChild(row);
        });

        if(totalSpan) totalSpan.textContent = formatPrice(total);

        document.querySelectorAll('.remove-item').forEach(btn => {
            btn.onclick = () => removeItem(btn.dataset.id);
        });
    }

    function removeItem(id){
        let cart = getCart();
        cart = cart.filter(i => i.id != id);
        setCart(cart);
    }

    function escapeHtml(text){
        return String(text).replace(/[&<>"'`=\/]/g, s => ({
            '&':'&amp;','<':'&lt;','>':'&gt;',
            '"':'&quot;',"'":'&#39;','/':'&#x2F;',
            '`':'&#x60;','=':'&#x3D;'
        })[s]);
    }

    document.addEventListener('DOMContentLoaded', function(){

        // LIMPAR CARRINHO
        const clearBtn = document.getElementById('clear-cart');
        if(clearBtn){
            clearBtn.addEventListener('click', function(){
                if(confirm('Deseja limpar o carrinho?')){
                    localStorage.removeItem('carrinho');
                    renderCart();
                    updateCartCount();
                }
            });
        }

        // CHECKOUT REAL
        const checkoutBtn = document.getElementById('checkout-btn');
        if(checkoutBtn){
            checkoutBtn.addEventListener('click', function(){

                const cart = getCart();

                if(!cart.length){
                    alert('Seu carrinho está vazio');
                    return;
                }

                fetch('/ZentralHead/php/clientes/salva_carrinho.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ carrinho: cart })
                })
                .then(r => r.json())
                .then(resp => {
                    if(resp.ok){
                        window.location.href = '/ZentralHead/php/clientes/checkout.php';
                    } else {
                        alert('Erro ao iniciar checkout');
                    }
                })
                .catch(() => alert('Erro de comunicação com o servidor'));
            });
        }

        renderCart();
        updateCartCount();
    });

})();


  const cartPopup = document.getElementById("cartPopup");
    const openCart = document.getElementById("openCart");
    const closeCart = document.getElementById("closeCart");

    // abrir carrinho
    openCart.addEventListener("click", (e) => {
      e.preventDefault(); // impede a página de rolar para o popup
      cartPopup.classList.add("active");
    });

    // fechar carrinho
    closeCart.addEventListener("click", () => {
      cartPopup.classList.remove("active");
    });
function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function prepareFormData() {
    var cartItems = document.cookie.replace(/(?:(?:^|.*;\s*)cartItems\s*\=\s*([^;]*).*$)|^.*$/, "$1");

    document.getElementById("donneesSupplementaires").value = cartItems;

    document.cookie = "cartItems=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

function displayProductsInModal() {
    var modalBody = document.querySelector('.row.border-top.border-bottom.rowpanier');
    var totalProductsCountElement = document.getElementById('nombreProduits');

    var cartItems = JSON.parse(getCookie('cartItems')) || [];

    var cartCount = cartItems.length;

    modalBody.innerHTML = '';

    cartItems.forEach(function (product) {
        var productDiv = document.createElement('div');
        productDiv.classList.add('row', 'main', 'align-items-center', 'rowpanier', 'mainpanier', 'product');

        
        productDiv.innerHTML = `
        <div class="col-2 col-2Panier aa" data-product-id="${product.id}">
            <img class="img-fluid" src="${product.image}">
        </div>
    
        <div class="col-4 col-2Panier" data-product-id="${product.id}">
            <div class="row text-muted rowpanier mb-2">${product.category}</div>
            <div class="row rowpanier mt-1">${product.name}</div>
        </div>
    
        <div class="col col-2Panier proQty ml-4" data-product-id="${product.id}">
            <a href="#" class="qtybtn minus">-</a>
            <a href="#" class="border lien quantity">${product.quantity}</a>
            <a href="#" class="qtybtn plus">+</a>
        </div>
    
        <div class="col col-2Panier product2" data-product-id="${product.id}">
            <label id="totalPriceProduct">${(product.priceUnitaire * product.quantity).toFixed(2)}</label>
            <span class="close closePanier">&#10005;</span>
        </div>

        <input type="hidden" id="hiddenProductId" value="${product.id}">
    `;

        modalBody.appendChild(productDiv);
    });

    totalProductsCountElement.textContent = cartCount;
}

function updatePrixTotalPanier() {
    var cartItems = JSON.parse(getCookie('cartItems')) || [];
    var totalPanierComplet = 0;

    cartItems.forEach(function (product) {
        totalPanierComplet += parseFloat(product.price
        );
    });

    $('#totalPanierComplet').text(totalPanierComplet.toFixed(2));
}

function removeProductFromCart(productId) {
    var cartItems = JSON.parse(getCookie('cartItems')) || [];

    var productIndex = cartItems.findIndex(item => item.id === productId);

    if (productIndex !== -1) {

        cartItems.splice(productIndex, 1);

        setCookie('cartItems', JSON.stringify(cartItems), 365);

        displayProductsInModal();

        updatePrixTotalPanier();
    }

    var totalProducts = document.getElementById('nombreProduits');
    totalProducts.textContent = cartItems.length;

    var cartDiv = document.querySelector('.header__top__right__cart');
    var cartCountSpan = cartDiv.querySelector('.cart-count');
    cartCountSpan.textContent = cartItems.length;
}


$(document).ready(function () {
    init();

    function init() {
        displayProductsInModal();
        updatePrixTotalPanier();
        setupAddToCartEvents();
        setupQuantityChangeEvents();
        setupRemoveProductEvents();
    }

    function setupAddToCartEvents() {
        var cartCountElement = document.querySelector('.cart-count');
        var addToCartButtons = document.querySelectorAll('.addToCart');

        var cartItems = JSON.parse(getCookie('cartItems')) || [];

        var cartCount = cartItems.length;
        cartCountElement.textContent = cartCount;

        addToCartButtons.forEach(function (button) {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                addToCart(button, cartItems, cartCountElement);
            });
        });
    }

    function addToCart(button, cartItems, cartCountElement) {
        var productId = button.getAttribute('data-id');
        var productImage = button.getAttribute('data-image');
        var productName = button.getAttribute('data-name');
        var productPrice = button.getAttribute('data-price');
        var productCategory = button.getAttribute('data-category');
        // var productQuantity = button.getAttribute('data-quantité');
        var productQuantity = $('#qq').val();
        var productPriceUnitaire = button.getAttribute('data-priceUnitaire');

        cartItems.push({
            id: productId,
            image: productImage,
            name: productName,
            price: parseFloat(productPrice),
            category: productCategory,
            quantity: productQuantity,
            priceUnitaire: parseFloat(productPriceUnitaire)
        });

        var cartCount = cartItems.length;
        cartCountElement.textContent = cartCount;

        setCookie('cartItems', JSON.stringify(cartItems), 6);

        displayProductsInModal();
        updatePrixTotalPanier();
        setupQuantityChangeEvents();
        setupRemoveProductEvents();
    }

    function setupQuantityChangeEvents() {

        $('.proQty').on('click', '.qtybtn', function () {
            var cartItems = JSON.parse(getCookie('cartItems')) || [];

            var $button = $(this);
            var productContainer = $button.closest('.product');
            var quantityElement = productContainer.find('.border.lien.quantity');
            var oldValue = parseInt(quantityElement.text(), 10);
            var totalPriceProduct = productContainer.find('#totalPriceProduct');

            var productId = productContainer.find('input[type="hidden"]').val();

            var productIndex = cartItems.findIndex(item => item.id === productId);

            var newVal;

            var product = cartItems[productIndex];

            if ($button.hasClass('plus')) {
                newVal = oldValue + 1;
            } else if ($button.hasClass('minus') && oldValue > 1) {
                newVal = oldValue - 1;
            } else {
                newVal = 0;
            }
            quantityElement.text(newVal.toString());

            product.quantity = newVal;

            product.price = (newVal * product.priceUnitaire).toFixed(2);

            totalPriceProduct.text(product.price);

            setCookie('cartItems', JSON.stringify(cartItems), 6);

            updatePrixTotalPanier();
            setupAddToCartEvents();
        });
    }

    function setupRemoveProductEvents() {

        $('.rowpanier').on('click', '.closePanier', function () {
            var productId = $(this).closest('.product').find('#hiddenProductId').val();
            removeProductFromCart(productId);
            setupAddToCartEvents();
        });
    }
});
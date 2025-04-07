<!-- Cart Modal HTML -->
<div id="cartModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-lg mx-4 overflow-hidden max-h-[90vh] flex flex-col">
        <div class="flex justify-between items-center border-b p-4">
            <h3 class="text-xl font-semibold">Sepetiniz</h3>
            <button id="closeCartModal" class="text-gray-400 hover:text-gray-600">
                <div class="w-6 h-6 flex items-center justify-center">
                    <i class="ri-close-line ri-lg"></i>
                </div>
            </button>
        </div>
        <!-- Empty Cart State -->
        <div id="emptyCartState" class="p-8 text-center flex-1 flex flex-col items-center justify-center">
            <div class="w-20 h-20 flex items-center justify-center text-gray-300 mb-4">
                <i class="ri-shopping-cart-line ri-4x"></i>
            </div>
            <h4 class="text-xl font-medium mb-2">Sepetiniz boş</h4>
            <p class="text-gray-500 mb-6">Ürünleri keşfedin ve sepetinize ekleyin</p>
            <button id="startShoppingBtn" class="bg-primary text-white px-6 py-3 !rounded-button hover:bg-opacity-90 transition-all whitespace-nowrap">
                Alışverişe Başla
            </button>
        </div>
        <!-- Cart With Items State -->
        <div id="cartWithItemsState" class="flex-1 flex flex-col hidden">
            <div class="flex-1 overflow-y-auto p-4">
                <div id="cartItemsList" class="space-y-4">
                    <!-- Cart items will be dynamically added here -->
                </div>
            </div>
            <div class="border-t p-4 bg-gray-50">
                <div class="flex justify-between mb-2">
                    <span class="text-gray-600">Ara Toplam:</span>
                    <span id="cartSubtotal" class="font-medium">0,00 TL</span>
                </div>
                <div class="flex justify-between mb-4">
                    <span class="text-gray-600">Kargo:</span>
                    <span id="cartShipping" class="font-medium">0,00 TL</span>
                </div>
                <div class="flex justify-between mb-6 text-lg font-bold">
                    <span>Toplam:</span>
                    <span id="cartTotal" class="text-primary">0,00 TL</span>
                </div>
                <button id="checkoutBtn" class="w-full bg-primary text-white py-3 !rounded-button hover:bg-opacity-90 transition-all flex items-center justify-center">
                    <div class="w-5 h-5 mr-2 flex items-center justify-center">
                        <i class="ri-secure-payment-line"></i>
                    </div>
                    Ödemeye Geç
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Cart items array
    const cartItems = [];

    // Cart modal elements
    const cartModal = document.getElementById('cartModal');
    const closeCartModal = document.getElementById('closeCartModal');
    const cartButton = document.getElementById('cartButton');
    const startShoppingBtn = document.getElementById('startShoppingBtn');
    const emptyCartState = document.getElementById('emptyCartState');
    const cartWithItemsState = document.getElementById('cartWithItemsState');
    const cartItemsList = document.getElementById('cartItemsList');
    const cartSubtotal = document.getElementById('cartSubtotal');
    const cartShipping = document.getElementById('cartShipping');
    const cartTotal = document.getElementById('cartTotal');
    const cartCount = document.getElementById('cartCount');
    const checkoutBtn = document.getElementById('checkoutBtn');

    // Function to format price
    function formatPrice(price) {
        return price.toLocaleString('tr-TR', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' TL';
    }

    // Function to show notification
    function showNotification(message, type = 'success', isCheckout = false) {
        const iconClass = type === 'success' ? 'ri-check-line' : type === 'info' ? 'ri-information-line' : 'ri-error-warning-line';
        const iconColor = type === 'success' ? 'text-green-500' : type === 'info' ? 'text-primary' : 'text-red-500';
        const notification = document.createElement('div');
        notification.className = 'fixed top-20 right-4 bg-white p-4 rounded-lg shadow-lg z-50 animate-fade-in';

        if (isCheckout) {
            notification.innerHTML = `
                <div class="flex items-center">
                    <div class="w-8 h-8 flex items-center justify-center ${iconColor} mr-3">
                        <i class="ri-secure-payment-line ri-lg"></i>
                    </div>
                    <div>
                        <p class="font-medium">${message}</p>
                        <p class="text-sm text-gray-600">Lütfen bekleyin...</p>
                    </div>
                </div>
            `;
        } else {
            notification.innerHTML = `
                <div class="flex items-center">
                    <div class="w-8 h-8 flex items-center justify-center ${iconColor} mr-3">
                        <i class="${iconClass} ri-lg"></i>
                    </div>
                    <div>
                        <p class="font-medium">${message}</p>
                    </div>
                </div>
            `;
        }

        document.body.appendChild(notification);

        // Remove notification after 3 seconds
        setTimeout(() => {
            notification.classList.add('animate-fade-out');
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }

    // Function to update cart UI
    function updateCartUI() {
        // Update cart count
        const totalItems = cartItems.reduce((total, item) => total + item.quantity, 0);
        cartCount.textContent = totalItems;

        // Show/hide appropriate cart state
        if (cartItems.length === 0) {
            emptyCartState.classList.remove('hidden');
            cartWithItemsState.classList.add('hidden');
        } else {
            emptyCartState.classList.add('hidden');
            cartWithItemsState.classList.remove('hidden');

            // Clear and rebuild cart items list
            cartItemsList.innerHTML = '';

            // Calculate totals
            let subtotal = 0;
            cartItems.forEach(item => {
                const itemTotal = item.price * item.quantity;
                subtotal += itemTotal;

                const itemElement = document.createElement('div');
                itemElement.className = 'flex items-center border-b border-gray-100 pb-4';
                itemElement.innerHTML = `
                    <div class="w-20 h-20 flex-shrink-0 bg-gray-100 rounded overflow-hidden mr-4">
                        <img src="${item.image}" alt="${item.name}" class="w-full h-full object-cover object-center">
                    </div>
                    <div class="flex-1">
                        <h4 class="font-medium">${item.name}</h4>
                        <p class="text-sm text-gray-500">${item.specs}</p>
                        <div class="flex items-center justify-between mt-2">
                            <div class="flex items-center border rounded">
                                <button class="decrease-quantity px-2 py-1 text-gray-500 hover:text-gray-700" data-id="${item.id}">
                                    <i class="ri-subtract-line"></i>
                                </button>
                                <span class="px-2 py-1 border-x">${item.quantity}</span>
                                <button class="increase-quantity px-2 py-1 text-gray-500 hover:text-gray-700" data-id="${item.id}">
                                    <i class="ri-add-line"></i>
                                </button>
                            </div>
                            <div class="flex items-center">
                                <span class="font-medium mr-3">${formatPrice(itemTotal)}</span>
                                <button class="remove-item text-gray-400 hover:text-red-500" data-id="${item.id}">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                cartItemsList.appendChild(itemElement);
            });

            // Add event listeners to quantity buttons and remove buttons
            cartItemsList.querySelectorAll('.decrease-quantity').forEach(button => {
                button.addEventListener('click', function() {
                    const id = parseInt(this.getAttribute('data-id'));
                    const item = cartItems.find(item => item.id === id);
                    if (item && item.quantity > 1) {
                        item.quantity--;
                        updateCartUI();
                    }
                });
            });

            cartItemsList.querySelectorAll('.increase-quantity').forEach(button => {
                button.addEventListener('click', function() {
                    const id = parseInt(this.getAttribute('data-id'));
                    const item = cartItems.find(item => item.id === id);
                    if (item) {
                        item.quantity++;
                        updateCartUI();
                    }
                });
            });

            cartItemsList.querySelectorAll('.remove-item').forEach(button => {
                button.addEventListener('click', function() {
                    const id = parseInt(this.getAttribute('data-id'));
                    const index = cartItems.findIndex(item => item.id === id);
                    if (index !== -1) {
                        cartItems.splice(index, 1);
                        updateCartUI();
                        showNotification('Ürün sepetten çıkarıldı', 'info');
                    }
                });
            });

            // Calculate shipping and total
            const shipping = subtotal > 0 ? 29.99 : 0;
            const total = subtotal + shipping;

            // Update totals in UI
            cartSubtotal.textContent = formatPrice(subtotal);
            cartShipping.textContent = formatPrice(shipping);
            cartTotal.textContent = formatPrice(total);
        }
    }

    // Cart modal functionality
    cartButton.addEventListener('click', function(e) {
        e.preventDefault();
        cartModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Prevent scrolling
        updateCartUI(); // Update cart UI when opening
    });

    closeCartModal.addEventListener('click', function() {
        cartModal.classList.add('hidden');
        document.body.style.overflow = ''; // Enable scrolling
    });

    cartModal.addEventListener('click', function(e) {
        if (e.target === cartModal) {
            cartModal.classList.add('hidden');
            document.body.style.overflow = ''; // Enable scrolling
        }
    });

    startShoppingBtn.addEventListener('click', function() {
        cartModal.classList.add('hidden');
        document.body.style.overflow = ''; // Enable scrolling
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    checkoutBtn.addEventListener('click', function() {
        if (cartItems.length === 0) {
            showNotification('Sepetinizde ürün bulunmamaktadır', 'error');
            return;
        }

        // Show checkout notification
        showNotification('Ödeme sayfasına yönlendiriliyorsunuz', 'success', true);

        // Close cart modal
        cartModal.classList.add('hidden');
        document.body.style.overflow = ''; // Enable scrolling

        // Simulate redirect to checkout page after 2 seconds
        setTimeout(() => {
            showNotification('Ödeme işlemi başarıyla tamamlandı', 'success');
            // Clear cart after successful checkout
            cartItems.length = 0;
            updateCartUI();
        }, 2000);
    });

    // Initialize cart UI
    updateCartUI();
</script>
@endpush

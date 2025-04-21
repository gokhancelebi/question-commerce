<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(request()->has('redirect_back'))
    <meta name="robots" content="noindex">
    @endif
    <title>Ürün Öneri Sistemi</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    @vite('resources/css/app.css')

    <style>
        /* Dropdown menu styles */
        .user-dropdown {
            position: relative;
            z-index: 60; /* Ensure dropdown container is above other elements */
        }

        .user-dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            margin-top: 0; /* Remove margin to eliminate gap */
            padding-top: 10px; /* Add padding at top instead of margin */
            z-index: 50;
        }

        /* This creates an invisible bridge between button and dropdown */
        .user-dropdown::after {
            content: '';
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            height: 20px; /* Taller bridge */
            display: block;
        }

        .user-dropdown:hover .user-dropdown-menu,
        .user-dropdown-menu:hover,
        .user-dropdown:hover::after {
            display: block;
        }

        #cartModal .bg-white {
            display: flex;
            flex-direction: column;
            max-height: 75vh;
        }
        #cartWithItemsState {
            display: flex;
            flex-direction: column;
        }
        .overflow-y-auto {
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }
        #cartModal .border-t {
            position: sticky;
            bottom: 0;
            background: white;
            z-index: 10;
        }
    </style>

</head>

<body class="bg-gray-50">
    <header class="sticky-header fixed w-full top-0 z-50 bg-white">
        <div class="container mx-auto max-w-6xl px-4 h-full flex items-center justify-between">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="text-3xl font-['Pacifico'] text-primary">logo</a>
            </div>
            <x-header-menu />
            <div class="flex items-center space-x-4">
                @auth
                <div class="relative user-dropdown">
                    <button id="userDropdownBtn" class="text-gray-800 hover:text-primary flex items-center">
                    <div class="w-10 h-10 flex items-center justify-center">
                        <i class="ri-user-line ri-lg"></i>
                    </div>
                        <span class="ml-1 hidden sm:inline">{{ Auth::user()->name }}</span>
                        <i class="ri-arrow-down-s-line ml-1"></i>
                    </button>
                    <div id="userDropdownMenu" class="absolute right-0 top-full w-48 user-dropdown-menu">
                        <div class="bg-white rounded-md shadow-lg py-1">
                            <a href="{{ route('user.account') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="ri-user-settings-line mr-2"></i> Hesabım
                            </a>
                            <a href="{{ route('user.orders') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="ri-history-line mr-2"></i> Siparişlerim
                            </a>
                            <div class="border-t border-gray-100 mt-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="ri-logout-box-line mr-2"></i> Çıkış Yap
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @else
                <div class="hidden md:block">
                    <a href="{{ route('login', ['redirect_back' => url()->current()]) }}" class="text-gray-800 hover:text-primary">
                        <div class="w-10 h-10 flex items-center justify-center">
                            <i class="ri-user-line ri-lg"></i>
                        </div>
                    </a>
                </div>
                @endauth

                <a href="{{ route('cart.index') }}" id="cartButton" class="text-gray-800 hover:text-primary relative">
                    <div class="w-10 h-10 flex items-center justify-center">
                        <i class="ri-shopping-cart-line ri-lg"></i>
                    </div>
                    <span id="cartCount"
                        class="absolute -top-1 -right-1 bg-primary text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">{{ count(Session::get('cart', [])) }}</span>
                </a>

                @guest
                <div class="hidden md:flex gap-2 items-center space-x-3">
                    <a href="{{ route('login', ['redirect_back' => url()->current()]) }}"
                        class="text-gray-800 hover:text-primary transition-colors whitespace-nowrap">Giriş</a>
                    <span class="text-gray-300"> | </span>
                    <a href="{{ route('register', ['redirect_back' => url()->current()]) }}"
                        class="text-gray-800 hover:text-primary transition-colors whitespace-nowrap">Kayıt</a>
                </div>
                <a href="{{ route('login', ['redirect_back' => url()->current()]) }}" class="md:hidden text-gray-800 hover:text-primary">
                    <div class="w-10 h-10 flex items-center justify-center">
                        <i class="ri-user-line ri-lg"></i>
                    </div>
                </a>
                @endguest

                <button id="mobileMenuToggle" class="md:hidden text-gray-800">
                    <div class="w-10 h-10 flex items-center justify-center">
                        <i class="ri-menu-line ri-lg"></i>
                    </div>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Menu -->
    <div id="mobileMenuContainer" class="fixed inset-0 z-40 hidden">
        <div class="absolute inset-0 bg-black bg-opacity-50" id="mobileMenuOverlay"></div>
        <div class="absolute right-0 top-0 bottom-0 w-64 bg-white shadow-lg transform transition-transform duration-300 translate-x-full" id="mobileMenuPanel">
            <div class="p-4 border-b flex justify-between items-center">
                <h3 class="text-xl font-semibold">Menü</h3>
                <button id="closeMobileMenu" class="text-gray-400 hover:text-gray-600">
                    <i class="ri-close-line ri-lg"></i>
                </button>
            </div>
            <div class="p-4">
                <nav class="flex flex-col space-y-4">
                    <a href="{{ route('home') }}" class="text-gray-800 hover:text-primary transition-colors py-2 border-b border-gray-100">Ana Sayfa</a>
                    <a href="{{ route('pages.show', 'hakkimizda') }}" class="text-gray-800 hover:text-primary transition-colors py-2 border-b border-gray-100">Hakkımızda</a>
                    <a href="{{ route('pages.show', 'iletisim') }}" class="text-gray-800 hover:text-primary transition-colors py-2 border-b border-gray-100">İletişim</a>
                </nav>
            </div>
        </div>
    </div>

    @yield('content')

    @include('front.partials.footer')

    @guest
    <!-- Modal HTML for login/register and cart -->
    <!-- Remove this entire auth modal section -->
    @endguest
    <!-- Cart Modal HTML -->
    <div id="cartModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-lg mx-4 overflow-hidden flex flex-col" style="max-height: 75vh;">
            <!-- Fixed Header -->
            <div class="flex justify-between items-center border-b p-4 bg-white flex-shrink-0">
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
                <div class="flex space-x-3">
                    <a href="{{ route('cart.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-md text-center transition-colors">
                        Sepete Git
                    </a>
                    <a href="{{ route('home') }}" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-md text-center transition-colors">
                        Yeniden Başlat
                    </a>
                </div>
            </div>
            <!-- Cart With Items State -->
            <div id="cartWithItemsState" class="hidden flex-1 flex flex-col">
                <div class="overflow-y-auto p-4 flex-1">
                    <!-- Cart items will be loaded dynamically -->
                    <div id="cartItems"></div>
                </div>
                <div class="border-t border-gray-200 p-4 bg-white">
                    <div class="flex justify-between mb-4">
                        <span class="font-medium">Toplam:</span>
                        <span class="font-bold" id="cartTotal">₺0.00</span>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('cart.index') }}" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-md text-center transition-colors">
                            Sepete Git
                        </a>
                        <a href="{{ route('checkout.index') }}" class="flex-1 bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-md text-center transition-colors">
                            Ödeme Yap
                        </a>
                    </div>
                    <div class="mt-2">
                        <a href="{{ route('home') }}" class="w-full block border border-gray-300 text-gray-700 px-4 py-2 rounded-md text-center hover:bg-gray-50 transition-colors">
                            Yeniden Başlat
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    @vite('resources/js/app.js')
    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cart modal functionality
            const cartButton = document.getElementById('cartButton');
            const cartModal = document.getElementById('cartModal');
            const closeCartModal = document.getElementById('closeCartModal');
            const emptyCartState = document.getElementById('emptyCartState');
            const cartWithItemsState = document.getElementById('cartWithItemsState');
            const cartItems = document.getElementById('cartItems');
            const cartTotal = document.getElementById('cartTotal');

            // Mobile menu functionality
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const mobileMenuContainer = document.getElementById('mobileMenuContainer');
            const mobileMenuPanel = document.getElementById('mobileMenuPanel');
            const closeMobileMenu = document.getElementById('closeMobileMenu');
            const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');

            // Toggle mobile menu
            if (mobileMenuToggle) {
                mobileMenuToggle.addEventListener('click', function() {
                    // Check if the menu is already open
                    if (mobileMenuContainer.classList.contains('hidden')) {
                        // Open the menu
                        mobileMenuContainer.classList.remove('hidden');
                        // Use setTimeout to ensure the animation works
                        setTimeout(() => {
                            mobileMenuPanel.classList.remove('translate-x-full');
                        }, 10);
                    } else {
                        // Close the menu
                        closeMobileMenuHandler();
                    }
                });
            }

            // Close mobile menu
            const closeMobileMenuHandler = function() {
                mobileMenuPanel.classList.add('translate-x-full');
                setTimeout(() => {
                    mobileMenuContainer.classList.add('hidden');
                }, 300); // Match the duration in the CSS
            };

            if (closeMobileMenu) {
                closeMobileMenu.addEventListener('click', closeMobileMenuHandler);
            }

            if (mobileMenuOverlay) {
                mobileMenuOverlay.addEventListener('click', closeMobileMenuHandler);
            }

            // Open cart modal
            if (cartButton) {
                cartButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    showCartModal();
                });
            }

            // Close cart modal
            if (closeCartModal) {
                closeCartModal.addEventListener('click', function() {
                    hideCartModal();
                });
            }

            // Close modal when clicking outside
            if (cartModal) {
                cartModal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        hideCartModal();
                    }
                });
            }

            // Escape key closes modal
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && cartModal && !cartModal.classList.contains('hidden')) {
                    hideCartModal();
                }
            });

            // Function to show cart modal
            window.showCartModal = function() {
                if (cartModal) {
                    cartModal.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                    updateCartUI();
                }
            };

            // Function to hide cart modal
            window.hideCartModal = function() {
                if (cartModal) {
                    cartModal.classList.add('hidden');
                    document.body.style.overflow = '';
                }
            };

            // Function to update cart UI
            window.updateCartUI = function() {
                fetch('/cart/get', {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    const cartCount = document.getElementById('cartCount');
                    if (cartCount) {
                        cartCount.textContent = data.items.length;
                    }

                    if (data.items.length === 0) {
                        if (emptyCartState) emptyCartState.classList.remove('hidden');
                        if (cartWithItemsState) cartWithItemsState.classList.add('hidden');
                        return;
                    }

                    if (emptyCartState) emptyCartState.classList.add('hidden');
                    if (cartWithItemsState) cartWithItemsState.classList.remove('hidden');

                    // Update cart items
                    if (cartItems) {
                        let html = '';
                        let total = 0;

                        data.items.forEach(item => {
                            const itemTotal = item.price * item.quantity;
                            total += itemTotal;

                            html += `
                                <div class="flex border-b border-gray-100 py-4 items-center" data-item-id="${item.id}">
                                    <div class="w-16 h-16 flex-shrink-0 mr-4 bg-gray-50 rounded overflow-hidden">
                                        <img src="${item.image || 'https://via.placeholder.com/80'}" alt="${item.name}" class="w-full h-full object-contain">
                                    </div>
                                    <div class="flex-grow">
                                        <h4 class="text-sm font-medium text-gray-900">${item.name}</h4>
                                        <div class="flex items-center mt-2">
                                            <button class="cart-qty-decrease w-8 h-8 flex items-center justify-center border rounded-l text-gray-600 hover:bg-gray-100">
                                                <i class="ri-subtract-line"></i>
                                            </button>
                                            <span class="cart-item-qty w-10 h-8 flex items-center justify-center border-t border-b">${item.quantity}</span>
                                            <button class="cart-qty-increase w-8 h-8 flex items-center justify-center border rounded-r text-gray-600 hover:bg-gray-100">
                                                <i class="ri-add-line"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="text-right ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            ₺${item.price.toLocaleString('tr-TR', { minimumFractionDigits: 2 })}
                                        </div>
                                        <button class="cart-item-remove mt-2 text-xs text-red-500 hover:text-red-700">
                                            <i class="ri-delete-bin-line"></i> Sil
                                        </button>
                                    </div>
                                </div>
                            `;
                        });

                        cartItems.innerHTML = html;

                        // Update cart total
                        if (cartTotal) {
                            cartTotal.textContent = '₺' + total.toLocaleString('tr-TR', { minimumFractionDigits: 2 });
                        }

                        // Add event listeners to cart item controls
                        document.querySelectorAll('.cart-qty-decrease').forEach(button => {
                            button.addEventListener('click', decreaseQuantity);
                        });

                        document.querySelectorAll('.cart-qty-increase').forEach(button => {
                            button.addEventListener('click', increaseQuantity);
                        });

                        document.querySelectorAll('.cart-item-remove').forEach(button => {
                            button.addEventListener('click', removeCartItem);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error loading cart:', error);
                });
            };

            // Function to decrease quantity
            function decreaseQuantity() {
                const itemContainer = this.closest('[data-item-id]');
                const itemId = itemContainer.getAttribute('data-item-id');
                const qtyElement = itemContainer.querySelector('.cart-item-qty');
                let qty = parseInt(qtyElement.textContent) - 1;

                if (qty <= 0) {
                    removeCartItem.call(this);
                    return;
                }

                updateCartItemQuantity(itemId, qty);
            }

            // Function to increase quantity
            function increaseQuantity() {
                const itemContainer = this.closest('[data-item-id]');
                const itemId = itemContainer.getAttribute('data-item-id');
                const qtyElement = itemContainer.querySelector('.cart-item-qty');
                let qty = parseInt(qtyElement.textContent) + 1;

                updateCartItemQuantity(itemId, qty);
            }

            // Function to remove cart item
            function removeCartItem() {
                const itemContainer = this.closest('[data-item-id]');
                const itemId = itemContainer.getAttribute('data-item-id');

                fetch('/cart/remove', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ id: itemId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateCartUI();
                    }
                })
                .catch(error => {
                    console.error('Error removing item:', error);
                });
            }

            // Function to update cart item quantity
            function updateCartItemQuantity(itemId, qty) {
                fetch('/cart/update-quantity', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ id: itemId, quantity: qty })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateCartUI();
                    }
                })
                .catch(error => {
                    console.error('Error updating quantity:', error);
                });
            }

            // Initial cart UI update
            setTimeout(updateCartUI, 1000);
        });
    </script>
</body>

</html>

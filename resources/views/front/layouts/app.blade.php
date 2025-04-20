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
                <a href="{{ route('login', ['redirect_back' => url()->current()]) }}" class="text-gray-800 hover:text-primary">
                    <div class="w-10 h-10 flex items-center justify-center">
                        <i class="ri-user-line ri-lg"></i>
                    </div>
                </a>
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
                <a href="{{ route('login', ['redirect_back' => url()->current()]) }}" class="text-gray-800 hover:text-primary md:hidden">
                    <div class="w-10 h-10 flex items-center justify-center">
                        <i class="ri-user-line ri-lg"></i>
                    </div>
                </a>
                @endguest

                <button class="md:hidden text-gray-800">
                    <div class="w-10 h-10 flex items-center justify-center">
                        <i class="ri-menu-line ri-lg"></i>
                    </div>
                </button>
            </div>
        </div>
    </header>
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
                <a href="{{ route('home') }}" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-md transition-colors">
                    Alışverişe Başla
                </a>
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
                    <div class="flex space-x-3">
                        <a href="{{ route('cart.index') }}" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-md text-center transition-colors">
                            Sepete Git
                        </a>
                        <a href="{{ route('checkout.index') }}" class="flex-1 bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-md text-center transition-colors">
                            Ödeme Yap
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    @vite('resources/js/app.js')
    @stack('scripts')
</body>

</html>

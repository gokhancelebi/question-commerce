<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Ürün Öneri Sistemi')</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>
        tailwind.config={
            theme:{
                extend:{
                    colors:{
                        primary:'#E37D10',
                        secondary:''
                    },
                    borderRadius:{
                        'none':'0px',
                        'sm':'4px',
                        DEFAULT:'8px',
                        'md':'12px',
                        'lg':'16px',
                        'xl':'20px',
                        '2xl':'24px',
                        '3xl':'32px',
                        'full':'9999px',
                        'button':'8px'
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        :where([class^="ri-"])::before { content: "\f3c2"; }
        body {
            font-family: 'Inter', sans-serif;
        }
        .sticky-header {
            height: 80px;
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: height 0.3s ease, box-shadow 0.3s ease;
        }
        .sticky-header.scrolled {
            height: 60px;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        @yield('styles')
    </style>
</head>
<body class="bg-gray-50">
    <header class="sticky-header fixed w-full top-0 z-50 bg-white">
        <div class="container mx-auto max-w-6xl px-4 h-full flex items-center justify-between">
            <div class="flex items-center">
                <a href="#" class="text-3xl font-['Pacifico'] text-primary">logo</a>
            </div>
            <nav class="hidden md:flex items-center space-x-8">
                <a href="#" class="text-gray-800 hover:text-primary transition-colors whitespace-nowrap">Ana Sayfa</a>
                <a href="#" class="text-gray-800 hover:text-primary transition-colors whitespace-nowrap">Hakkımızda</a>
                <a href="#" class="text-gray-800 hover:text-primary transition-colors whitespace-nowrap">İletişim</a>
            </nav>
            <div class="flex items-center space-x-4">
                <a href="#" class="text-gray-800 hover:text-primary">
                    <div class="w-10 h-10 flex items-center justify-center">
                        <i class="ri-user-line ri-lg"></i>
                    </div>
                </a>
                <a href="#" id="cartButton" class="text-gray-800 hover:text-primary relative">
                    <div class="w-10 h-10 flex items-center justify-center">
                        <i class="ri-shopping-cart-line ri-lg"></i>
                    </div>
                    <span id="cartCount" class="absolute -top-1 -right-1 bg-primary text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">0</span>
                </a>
                <button id="loginRegisterBtn" class="hidden md:block bg-primary text-white px-4 py-2 !rounded-button hover:bg-opacity-90 transition-all whitespace-nowrap">Giriş / Kayıt</button>
                <button class="md:hidden text-gray-800">
                    <div class="w-10 h-10 flex items-center justify-center">
                        <i class="ri-menu-line ri-lg"></i>
                    </div>
                </button>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-white pt-16 pb-8 px-4">
        <div class="container mx-auto max-w-6xl">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <div>
                    <a href="#" class="text-3xl font-['Pacifico'] text-white mb-4 inline-block">logo</a>
                    <p class="text-gray-400 mb-6">Akıllı sorular ve kişiselleştirilmiş öneriler aracılığıyla mükemmel ürününüzü bulun.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <div class="w-10 h-10 flex items-center justify-center">
                                <i class="ri-facebook-fill ri-lg"></i>
                            </div>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <div class="w-10 h-10 flex items-center justify-center">
                                <i class="ri-twitter-x-fill ri-lg"></i>
                            </div>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <div class="w-10 h-10 flex items-center justify-center">
                                <i class="ri-instagram-fill ri-lg"></i>
                            </div>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <div class="w-10 h-10 flex items-center justify-center">
                                <i class="ri-linkedin-fill ri-lg"></i>
                            </div>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Hızlı Bağlantılar</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Ana Sayfa</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Hakkımızda</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Nasıl Çalışır</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Müşteri Yorumları</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">İletişim</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Müşteri Desteği</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">SSS</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Kargo Politikası</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">İade ve Geri Ödemeler</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Gizlilik Politikası</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Kullanım Şartları</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Bülten</h3>
                    <p class="text-gray-400 mb-4">Özel teklifler ve ürün güncellemeleri almak için abone olun.</p>
                    <form class="mb-4">
                        <div class="flex">
                            <input type="email" placeholder="E-posta adresiniz" class="bg-gray-800 text-white px-4 py-2 w-full border-none !rounded-l-button focus:outline-none focus:ring-2 focus:ring-primary">
                            <button type="submit" class="bg-primary text-white px-4 py-2 !rounded-r-button hover:bg-opacity-90 whitespace-nowrap">Abone Ol</button>
                        </div>
                    </form>
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 flex items-center justify-center">
                            <i class="ri-visa-fill ri-lg text-gray-400"></i>
                        </div>
                        <div class="w-8 h-8 flex items-center justify-center">
                            <i class="ri-mastercard-fill ri-lg text-gray-400"></i>
                        </div>
                        <div class="w-8 h-8 flex items-center justify-center">
                            <i class="ri-paypal-fill ri-lg text-gray-400"></i>
                        </div>
                        <div class="w-8 h-8 flex items-center justify-center">
                            <i class="ri-apple-fill ri-lg text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center text-gray-500">
                <p>&copy; 2025 Ürün Öneri Sistemi. Tüm hakları saklıdır.</p>
            </div>
        </div>
    </footer>

    @include('fromt.partials.auth-modal')
    @include('fromt.partials.cart-modal')

    <script>
        // Sticky header functionality
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.sticky-header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        @yield('scripts')
    </script>
</body>
</html>

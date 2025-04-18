<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ürün Öneri Sistemi</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    @vite('resources/css/app.css')

</head>

<body class="bg-gray-50">
    <header class="sticky-header fixed w-full top-0 z-50 bg-white">
        <div class="container mx-auto max-w-6xl px-4 h-full flex items-center justify-between">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="text-3xl font-['Pacifico'] text-primary">logo</a>
            </div>
            <nav class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-gray-800 hover:text-primary transition-colors whitespace-nowrap">Ana
                    Sayfa</a>
                <a href="{{ route('pages.show', 'hakkimizda') }}"
                    class="text-gray-800 hover:text-primary transition-colors whitespace-nowrap">Hakkımızda</a>
                <a href="{{ route('pages.show', 'nasil-calisir') }}"
                    class="text-gray-800 hover:text-primary transition-colors whitespace-nowrap">Nasıl Çalışır</a>
                <a href="{{ route('pages.show', 'iletisim') }}"
                    class="text-gray-800 hover:text-primary transition-colors whitespace-nowrap">İletişim</a>
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
                    <span id="cartCount"
                        class="absolute -top-1 -right-1 bg-primary text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">0</span>
                </a>
                <button id="loginRegisterBtn"
                    class="hidden md:block bg-primary text-white px-4 py-2 !rounded-button hover:bg-opacity-90 transition-all whitespace-nowrap">Giriş
                    / Kayıt</button>
                <button class="md:hidden text-gray-800">
                    <div class="w-10 h-10 flex items-center justify-center">
                        <i class="ri-menu-line ri-lg"></i>
                    </div>
                </button>
            </div>
        </div>
    </header>
   @yield('content')
    <footer class="bg-gray-900 text-white pt-16 pb-8 px-4">
        <div class="container mx-auto max-w-6xl">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <div>
                    <a href="{{ route('home') }}" class="text-3xl font-['Pacifico'] text-white mb-4 inline-block">logo</a>
                    <p class="text-gray-400 mb-6">Akıllı sorular ve kişiselleştirilmiş öneriler aracılığıyla mükemmel
                        ürününüzü bulun.</p>
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
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition-colors">Ana Sayfa</a>
                        </li>
                        <li><a href="{{ route('pages.show', 'hakkimizda') }}" class="text-gray-400 hover:text-white transition-colors">Hakkımızda</a>
                        </li>
                        <li><a href="{{ route('pages.show', 'nasil-calisir') }}" class="text-gray-400 hover:text-white transition-colors">Nasıl
                                Çalışır</a></li>
                        <li><a href="{{ route('pages.show', 'iletisim') }}" class="text-gray-400 hover:text-white transition-colors">İletişim</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Müşteri Desteği</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">SSS</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Kargo
                                Politikası</a>
                        </li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">İade ve Geri
                                Ödemeler</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Gizlilik
                                Politikası</a>
                        </li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Kullanım
                                Şartları</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center text-gray-500">
                <p>&copy; 2025 Ürün Öneri Sistemi. Tüm hakları saklıdır.</p>
            </div>
        </div>
    </footer>
    <!-- Modal HTML for login/register and cart -->
    <div id="authModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 overflow-hidden">
            <div class="flex border-b">
                <button id="loginTab"
                    class="flex-1 py-4 font-medium text-center border-b-2 border-primary text-primary">Giriş</button>
                <button id="registerTab"
                    class="flex-1 py-4 font-medium text-center border-b-2 border-transparent text-gray-500">Kayıt
                    Ol</button>
                <button id="closeAuthModal" class="px-4 text-gray-400 hover:text-gray-600">
                    <div class="w-6 h-6 flex items-center justify-center">
                        <i class="ri-close-line ri-lg"></i>
                    </div>
                </button>
            </div>
            <!-- Login Form -->
            <div id="loginForm" class="p-6">
                <form class="space-y-4">
                    <div>
                        <label for="loginEmail" class="block text-sm font-medium text-gray-700 mb-1">E-posta /
                            Kullanıcı
                            Adı</label>
                        <input type="text" id="loginEmail"
                            class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-primary focus:border-primary"
                            placeholder="E-posta adresinizi girin">
                    </div>
                    <div>
                        <label for="loginPassword" class="block text-sm font-medium text-gray-700 mb-1">Şifre</label>
                        <input type="password" id="loginPassword"
                            class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-primary focus:border-primary"
                            placeholder="Şifrenizi girin">
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="rememberMe"
                            class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                        <label for="rememberMe" class="ml-2 block text-sm text-gray-700">Beni Hatırla</label>
                        <a href="#" class="ml-auto text-sm text-primary hover:underline">Şifremi Unuttum</a>
                    </div>
                    <button type="submit"
                        class="w-full bg-primary text-white py-2 !rounded-button hover:bg-opacity-90 transition-all">Giriş
                        Yap</button>
                </form>
                <!--
                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">veya şununla devam et</span>
                        </div>
                    </div>
                    <div class="mt-6 grid grid-cols-3 gap-3">
                        <button
                            class="flex justify-center items-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white hover:bg-gray-50">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-google-fill text-red-500"></i>
                            </div>
                        </button>
                        <button
                            class="flex justify-center items-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white hover:bg-gray-50">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-facebook-fill text-blue-600"></i>
                            </div>
                        </button>
                        <button
                            class="flex justify-center items-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white hover:bg-gray-50">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-apple-fill"></i>
                            </div>
                        </button>
                    </div>
                </div>
            -->
            </div>
            <!-- Register Form -->
            <div id="registerForm" class="p-6 hidden">
                <form class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="firstName" class="block text-sm font-medium text-gray-700 mb-1">Ad</label>
                            <input type="text" id="firstName"
                                class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-primary focus:border-primary"
                                placeholder="Adınız">
                        </div>
                        <div>
                            <label for="lastName" class="block text-sm font-medium text-gray-700 mb-1">Soyad</label>
                            <input type="text" id="lastName"
                                class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-primary focus:border-primary"
                                placeholder="Soyadınız">
                        </div>
                    </div>
                    <div>
                        <label for="registerEmail"
                            class="block text-sm font-medium text-gray-700 mb-1">E-posta</label>
                        <input type="email" id="registerEmail"
                            class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-primary focus:border-primary"
                            placeholder="E-posta adresiniz">
                    </div>
                    <div>
                        <label for="registerPassword"
                            class="block text-sm font-medium text-gray-700 mb-1">Şifre</label>
                        <input type="password" id="registerPassword"
                            class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-primary focus:border-primary"
                            placeholder="Şifreniz (en az 8 karakter)">
                    </div>
                    <div>
                        <label for="confirmPassword" class="block text-sm font-medium text-gray-700 mb-1">Şifre
                            Tekrar</label>
                        <input type="password" id="confirmPassword"
                            class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-primary focus:border-primary"
                            placeholder="Şifrenizi tekrar girin">
                    </div>
                    <div class="flex items-start">
                        <input type="checkbox" id="termsAccept"
                            class="h-4 w-4 mt-1 text-primary focus:ring-primary border-gray-300 rounded">
                        <label for="termsAccept" class="ml-2 block text-sm text-gray-700">
                            <a href="#" class="text-primary hover:underline">Kullanım Şartları</a> ve <a
                                href="#" class="text-primary hover:underline">Gizlilik Politikası</a>'nı kabul
                            ediyorum
                        </label>
                    </div>
                    <button type="submit"
                        class="w-full bg-primary text-white py-2 !rounded-button hover:bg-opacity-90 transition-all">Kayıt
                        Ol</button>
                </form>
                <!--
                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">veya şununla kayıt ol</span>
                        </div>
                    </div>
                    <div class="mt-6 grid grid-cols-3 gap-3">
                        <button
                            class="flex justify-center items-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white hover:bg-gray-50">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-google-fill text-red-500"></i>
                            </div>
                        </button>
                        <button
                            class="flex justify-center items-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white hover:bg-gray-50">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-facebook-fill text-blue-600"></i>
                            </div>
                        </button>
                        <button
                            class="flex justify-center items-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white hover:bg-gray-50">
                            <div class="w-5 h-5 flex items-center justify-center">
                                <i class="ri-apple-fill"></i>
                            </div>
                        </button>
                    </div>
                </div>
            -->
            </div>
        </div>
    </div>
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
                <button id="startShoppingBtn"
                    class="bg-primary text-white px-6 py-3 !rounded-button hover:bg-opacity-90 transition-all whitespace-nowrap">
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
                    <button id="checkoutBtn"
                        class="w-full bg-primary text-white py-3 !rounded-button hover:bg-opacity-90 transition-all flex items-center justify-center">
                        <div class="w-5 h-5 mr-2 flex items-center justify-center">
                            <i class="ri-secure-payment-line"></i>
                        </div>
                        Ödemeye Geç
                    </button>
                </div>
            </div>
        </div>
    </div>
    @vite('resources/js/app.js')
    <script>
        // Mock data for questions and options
        const questions = [{
                id: 1,
                question: "Temel kullanım amacınız nedir?",
                options: [{
                        id: 1,
                        title: "Profesyonel İş"
                    },
                    {
                        id: 2,
                        title: "Eğlence"
                    },
                    {
                        id: 3,
                        title: "Günlük Kullanım"
                    },
                    {
                        id: 4,
                        title: "Öğrenci"
                    },
                    {
                        id: 5,
                        title: "Yaratıcı İş"
                    }
                ]
            },
            {
                id: 2,
                question: "Bütçe aralığınız nedir?",
                options: [{
                        id: 1,
                        title: "Ekonomik (0-5.000 TL)"
                    },
                    {
                        id: 2,
                        title: "Orta Seviye (5.000-10.000 TL)"
                    },
                    {
                        id: 3,
                        title: "Premium (10.000-15.000 TL)"
                    },
                    {
                        id: 4,
                        title: "Lüks (15.000-25.000 TL)"
                    },
                    {
                        id: 5,
                        title: "Sınırsız (25.000 TL üzeri)"
                    }
                ]
            },
            {
                id: 3,
                question: "Hangi boyutu tercih edersiniz?",
                options: [{
                        id: 1,
                        title: "Kompakt (13\" veya daha küçük)"
                    },
                    {
                        id: 2,
                        title: "Orta (14-15\")"
                    },
                    {
                        id: 3,
                        title: "Büyük (16-17\")"
                    },
                    {
                        id: 4,
                        title: "Ekstra Büyük (17\"+ veya Masaüstü)"
                    }
                ]
            },
            {
                id: 4,
                question: "Sizin için en önemli özellikler hangileri?",
                options: [{
                        id: 1,
                        title: "Performans"
                    },
                    {
                        id: 2,
                        title: "Pil Ömrü"
                    },
                    {
                        id: 3,
                        title: "Ekran Kalitesi"
                    },
                    {
                        id: 4,
                        title: "Depolama Kapasitesi"
                    },
                    {
                        id: 5,
                        title: "Grafik Kapasitesi"
                    }
                ]
            },
            {
                id: 5,
                question: "Ne kadar acil ihtiyacınız var?",
                options: [{
                        id: 1,
                        title: "Acil (1-2 gün)"
                    },
                    {
                        id: 2,
                        title: "Bir hafta içinde"
                    },
                    {
                        id: 3,
                        title: "2 hafta içinde"
                    },
                    {
                        id: 4,
                        title: "Acele yok"
                    }
                ]
            }
        ];
        // Mock product data
        const mockProducts = [{
                id: 1,
                name: "UltraBook Pro X15",
                price: 12999.99,
                image: "https://readdy.ai/api/search-image?query=professional laptop with sleek design, silver color, open display showing clear screen, on minimal white background, product photography, high resolution, commercial quality&width=800&height=450&seq=101&orientation=landscape",
                specs: "15.6\" 4K, Intel Core i7, 16GB RAM, 1TB SSD"
            },
            {
                id: 2,
                name: "ProBook Elite 14",
                price: 9499.99,
                image: "https://readdy.ai/api/search-image?query=sleek modern laptop with dark gray color, open display showing clear screen, on minimal white background, product photography, high resolution, commercial quality&width=400&height=225&seq=102&orientation=landscape",
                specs: "14\" FHD, Intel Core i5, 8GB RAM, 512GB SSD"
            },
            {
                id: 3,
                name: "UltraSlim 15",
                price: 14299.99,
                image: "https://readdy.ai/api/search-image?query=premium gold color laptop with slim design, open display showing clear screen, on minimal white background, product photography, high resolution, commercial quality&width=400&height=225&seq=103&orientation=landscape",
                specs: "15.6\" 4K OLED, Intel Core i7, 16GB RAM, 1TB SSD"
            },
            {
                id: 4,
                name: "PowerBook Pro 16",
                price: 16799.99,
                image: "https://readdy.ai/api/search-image?query=professional black laptop with modern design, open display showing clear screen, on minimal white background, product photography, high resolution, commercial quality&width=400&height=225&seq=104&orientation=landscape",
                specs: "16\" QHD+, Intel Core i9, 32GB RAM, 2TB SSD"
            }
        ];
        // Track user answers
        const userAnswers = {
            question1: null,
            question2: null,
            question3: null,
            question4: null,
            question5: null
        };
        // Cart items array
        const cartItems = [];
        // DOM Elements
        const progressSteps = document.querySelectorAll('.progress-step');
        const progressLines = document.querySelectorAll('.progress-line');
        const questionSlides = document.querySelectorAll('.question-slide');
        const nextButtons = document.querySelectorAll('.next-question');
        const prevButtons = document.querySelectorAll('.prev-question');
        const showResultsBtn = document.getElementById('showResultsBtn');
        const productRecommendation = document.getElementById('productRecommendation');
        // Auth modal elements
        const authModal = document.getElementById('authModal');
        const loginTab = document.getElementById('loginTab');
        const registerTab = document.getElementById('registerTab');
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');
        const closeAuthModal = document.getElementById('closeAuthModal');
        const loginRegisterBtn = document.getElementById('loginRegisterBtn');
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
        // Sticky header functionality
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.sticky-header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
        // Function to update progress indicator
        function updateProgressIndicator(currentStep) {
            // Update the progress bar using ID selector
            const progressBar = document.getElementById('progressBar');
            if (progressBar) {
                const width = (currentStep - 1) * 25;
                progressBar.style.width = `${width}%`;
            }

            progressSteps.forEach((step, index) => {
                const stepNumber = index + 1;
                const stepElement = step.querySelector('div');
                if (stepNumber < currentStep) {
                    // Completed step
                    stepElement.classList.remove('bg-gray-200', 'text-gray-600');
                    stepElement.classList.add('bg-primary', 'text-white');
                    stepElement.innerHTML = '<i class="ri-check-line"></i>';
                } else if (stepNumber === currentStep) {
                    // Current step
                    stepElement.classList.remove('bg-gray-200', 'text-gray-600');
                    stepElement.classList.add('bg-primary', 'text-white');
                    stepElement.innerHTML = `<span>${stepNumber}</span>`;
                } else {
                    // Future step
                    stepElement.classList.remove('bg-primary', 'text-white');
                    stepElement.classList.add('bg-gray-200', 'text-gray-600');
                    stepElement.innerHTML = `<span>${stepNumber}</span>`;
                }
            });
        }
        // Function to show a question slide
        function showQuestionSlide(slideNumber) {
            questionSlides.forEach((slide, index) => {
                const currentSlideNumber = parseInt(slide.getAttribute('data-question'));
                // First remove all classes
                slide.classList.remove('active', 'prev');
                // Set position based on relation to target slide
                if (currentSlideNumber === slideNumber) {
                    // Target slide - make active
                    slide.classList.add('active');
                    slide.style.transform = 'translateX(0)';
                    slide.style.opacity = '1';
                    slide.style.pointerEvents = 'auto';
                } else if (currentSlideNumber < slideNumber) {
                    // Slides before target - move left
                    slide.classList.add('prev');
                    slide.style.transform = 'translateX(-50px)';
                    slide.style.opacity = '0';
                    slide.style.pointerEvents = 'none';
                } else {
                    // Slides after target - position right
                    slide.style.transform = 'translateX(50px)';
                    slide.style.opacity = '0';
                    slide.style.pointerEvents = 'none';
                }
            });
            updateProgressIndicator(slideNumber);
        }
        // Function to show error message
        function showErrorMessage(slide, message) {
            // Remove any existing error messages
            const existingError = slide.querySelector('.text-red-500');
            if (existingError) {
                existingError.remove();
            }
            // Create and show error message
            const errorMsg = document.createElement('div');
            errorMsg.className = 'text-red-500 mt-4 text-center';
            errorMsg.textContent = message;
            // Add the error message
            slide.appendChild(errorMsg);
            // Remove the error message after 3 seconds
            setTimeout(() => {
                errorMsg.remove();
            }, 3000);
        }
        // Function to format price
        function formatPrice(price) {
            return price.toLocaleString('tr-TR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }) + ' TL';
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
        // Function to show notification
        function showNotification(message, type = 'success', isCheckout = false) {
            const iconClass = type === 'success' ? 'ri-check-line' : type === 'info' ? 'ri-information-line' :
                'ri-error-warning-line';
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
        // Add event listeners to radio buttons
        document.querySelectorAll('.custom-radio input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const questionNumber = this.name.replace('question', '');
                userAnswers[this.name] = this.value;
            });
        });
        // Add event listeners to next buttons
        nextButtons.forEach(button => {
            button.addEventListener('click', function() {
                const slide = this.closest('.question-slide');
                const questionNumber = parseInt(slide.getAttribute('data-question'));
                const selectedOption = document.querySelector(
                    `input[name="question${questionNumber}"]:checked`);
                // Check if an option is selected
                if (!selectedOption) {
                    showErrorMessage(slide, 'Lütfen devam etmek için bir seçenek belirleyin.');
                    return;
                }
                // Store the answer
                userAnswers[`question${questionNumber}`] = selectedOption.value;
                // Show next question
                const nextQuestionNumber = questionNumber + 1;
                console.log(`Moving from question ${questionNumber} to question ${nextQuestionNumber}`);
                showQuestionSlide(nextQuestionNumber);
            });
        });
        // Add event listeners to previous buttons
        prevButtons.forEach(button => {
            button.addEventListener('click', function() {
                const slide = this.closest('.question-slide');
                const questionNumber = parseInt(slide.getAttribute('data-question'));
                // Show previous question
                showQuestionSlide(questionNumber - 1);
            });
        });
        // Add event listener to show results button
        showResultsBtn.addEventListener('click', function() {
            const slide = this.closest('.question-slide');
            const questionNumber = parseInt(slide.getAttribute('data-question'));
            const selectedOption = document.querySelector(`input[name="question${questionNumber}"]:checked`);
            // Check if an option is selected
            if (!selectedOption) {
                showErrorMessage(slide, 'Lütfen devam etmek için bir seçenek belirleyin.');
                return;
            }
            // Store the answer
            userAnswers[`question${questionNumber}`] = selectedOption.value;
            // Show loading indicator
            const loadingIndicator = document.createElement('div');
            loadingIndicator.className =
                'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
            loadingIndicator.innerHTML = `
<div class="bg-white p-6 rounded-lg shadow-lg text-center">
<div class="w-16 h-16 border-4 border-primary border-t-transparent rounded-full animate-spin mx-auto mb-4"></div>
<p class="text-lg font-medium">Mükemmel eşleşmeniz bulunuyor...</p>
</div>
`;
            document.body.appendChild(loadingIndicator);
            // Simulate API call to get product recommendation based on answers
            setTimeout(() => {
                // Remove loading indicator
                document.body.removeChild(loadingIndicator);
                // Show product recommendation
                productRecommendation.classList.remove('hidden');
                // Scroll to the recommendation
                productRecommendation.scrollIntoView({
                    behavior: 'smooth'
                });
                // Update progress indicator to show completion
                updateProgressIndicator(5);
            }, 1500);
        });
        // Auth modal functionality
        loginRegisterBtn.addEventListener('click', function() {
            authModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        });
        closeAuthModal.addEventListener('click', function() {
            authModal.classList.add('hidden');
            document.body.style.overflow = ''; // Enable scrolling
        });
        authModal.addEventListener('click', function(e) {
            if (e.target === authModal) {
                authModal.classList.add('hidden');
                document.body.style.overflow = ''; // Enable scrolling
            }
        });
        // Switch tabs
        loginTab.addEventListener('click', function() {
            loginTab.classList.add('border-primary', 'text-primary');
            registerTab.classList.remove('border-primary', 'text-primary');
            loginTab.classList.remove('border-transparent', 'text-gray-500');
            registerTab.classList.add('border-transparent', 'text-gray-500');
            loginForm.classList.remove('hidden');
            registerForm.classList.add('hidden');
        });
        registerTab.addEventListener('click', function() {
            registerTab.classList.add('border-primary', 'text-primary');
            loginTab.classList.remove('border-primary', 'text-primary');
            registerTab.classList.remove('border-transparent', 'text-gray-500');
            loginTab.classList.add('border-transparent', 'text-gray-500');
            registerForm.classList.remove('hidden');
            loginForm.classList.add('hidden');
        });
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
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
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
        // Add event listeners to "Sepete Ekle" and "Alışverişe Devam Et" buttons
        document.querySelectorAll('#productRecommendation button').forEach(button => {
            button.addEventListener('click', function() {
                const isAddToCart = button.textContent.includes('Sepete Ekle');
                if (isAddToCart) {
                    // Add product to cart
                    const product = mockProducts[0]; // Main recommended product
                    const existingItem = cartItems.find(item => item.id === product.id);
                    if (existingItem) {
                        existingItem.quantity++;
                    } else {
                        cartItems.push({
                            id: product.id,
                            name: product.name,
                            price: product.price,
                            image: product.image,
                            specs: product.specs,
                            quantity: 1
                        });
                    }
                    // Update cart UI
                    updateCartUI();
                    showNotification(
                        `Ürün sepete eklendi! Sepetinizde şimdi ${cartItems.reduce((total, item) => total + item.quantity, 0)} ürün var.`,
                        'success');
                    // Open cart modal after a short delay
                    setTimeout(() => {
                        cartModal.classList.remove('hidden');
                        document.body.style.overflow = 'hidden';
                    }, 1000);
                } else {
                    showNotification('Alışverişe devam ediyorsunuz. Daha fazla ürün keşfedin.', 'info');
                    // Scroll to top of page
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                }
            });
        });
        // Add animation classes
        const style = document.createElement('style');
        style.textContent = `
.animate-fade-in {
animation: fadeIn 0.3s ease-in-out;
}
.animate-fade-out {
animation: fadeOut 0.3s ease-in-out;
}
@keyframes fadeIn {
from { opacity: 0; transform: translateY(-10px); }
to { opacity: 1; transform: translateY(0); }
}
@keyframes fadeOut {
from { opacity: 1; transform: translateY(0); }
to { opacity: 0; transform: translateY(-10px); }
}
`;
        document.head.appendChild(style);
        // Initialize the first question as active
        showQuestionSlide(1);
        updateCartUI();
    </script>

    @yield('scripts')
    @stack('scripts')
</body>

</html>

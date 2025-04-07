<!-- Modal HTML for login/register -->
<div id="authModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 overflow-hidden">
        <div class="flex border-b">
            <button id="loginTab" class="flex-1 py-4 font-medium text-center border-b-2 border-primary text-primary">Giriş</button>
            <button id="registerTab" class="flex-1 py-4 font-medium text-center border-b-2 border-transparent text-gray-500">Kayıt Ol</button>
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
                    <label for="loginEmail" class="block text-sm font-medium text-gray-700 mb-1">E-posta / Kullanıcı Adı</label>
                    <input type="text" id="loginEmail" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-primary focus:border-primary" placeholder="E-posta adresinizi girin">
                </div>
                <div>
                    <label for="loginPassword" class="block text-sm font-medium text-gray-700 mb-1">Şifre</label>
                    <input type="password" id="loginPassword" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-primary focus:border-primary" placeholder="Şifrenizi girin">
                </div>
                <div class="flex items-center">
                    <input type="checkbox" id="rememberMe" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                    <label for="rememberMe" class="ml-2 block text-sm text-gray-700">Beni Hatırla</label>
                    <a href="#" class="ml-auto text-sm text-primary hover:underline">Şifremi Unuttum</a>
                </div>
                <button type="submit" class="w-full bg-primary text-white py-2 !rounded-button hover:bg-opacity-90 transition-all">Giriş Yap</button>
            </form>
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
                    <button class="flex justify-center items-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white hover:bg-gray-50">
                        <div class="w-5 h-5 flex items-center justify-center">
                            <i class="ri-google-fill text-red-500"></i>
                        </div>
                    </button>
                    <button class="flex justify-center items-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white hover:bg-gray-50">
                        <div class="w-5 h-5 flex items-center justify-center">
                            <i class="ri-facebook-fill text-blue-600"></i>
                        </div>
                    </button>
                    <button class="flex justify-center items-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white hover:bg-gray-50">
                        <div class="w-5 h-5 flex items-center justify-center">
                            <i class="ri-apple-fill"></i>
                        </div>
                    </button>
                </div>
            </div>
        </div>
        <!-- Register Form -->
        <div id="registerForm" class="p-6 hidden">
            <form class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="firstName" class="block text-sm font-medium text-gray-700 mb-1">Ad</label>
                        <input type="text" id="firstName" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-primary focus:border-primary" placeholder="Adınız">
                    </div>
                    <div>
                        <label for="lastName" class="block text-sm font-medium text-gray-700 mb-1">Soyad</label>
                        <input type="text" id="lastName" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-primary focus:border-primary" placeholder="Soyadınız">
                    </div>
                </div>
                <div>
                    <label for="registerEmail" class="block text-sm font-medium text-gray-700 mb-1">E-posta</label>
                    <input type="email" id="registerEmail" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-primary focus:border-primary" placeholder="E-posta adresiniz">
                </div>
                <div>
                    <label for="registerPassword" class="block text-sm font-medium text-gray-700 mb-1">Şifre</label>
                    <input type="password" id="registerPassword" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-primary focus:border-primary" placeholder="Şifreniz (en az 8 karakter)">
                </div>
                <div>
                    <label for="confirmPassword" class="block text-sm font-medium text-gray-700 mb-1">Şifre Tekrar</label>
                    <input type="password" id="confirmPassword" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-primary focus:border-primary" placeholder="Şifrenizi tekrar girin">
                </div>
                <div class="flex items-start">
                    <input type="checkbox" id="termsAccept" class="h-4 w-4 mt-1 text-primary focus:ring-primary border-gray-300 rounded">
                    <label for="termsAccept" class="ml-2 block text-sm text-gray-700">
                        <a href="#" class="text-primary hover:underline">Kullanım Şartları</a> ve <a href="#" class="text-primary hover:underline">Gizlilik Politikası</a>'nı kabul ediyorum
                    </label>
                </div>
                <button type="submit" class="w-full bg-primary text-white py-2 !rounded-button hover:bg-opacity-90 transition-all">Kayıt Ol</button>
            </form>
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
                    <button class="flex justify-center items-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white hover:bg-gray-50">
                        <div class="w-5 h-5 flex items-center justify-center">
                            <i class="ri-google-fill text-red-500"></i>
                        </div>
                    </button>
                    <button class="flex justify-center items-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white hover:bg-gray-50">
                        <div class="w-5 h-5 flex items-center justify-center">
                            <i class="ri-facebook-fill text-blue-600"></i>
                        </div>
                    </button>
                    <button class="flex justify-center items-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white hover:bg-gray-50">
                        <div class="w-5 h-5 flex items-center justify-center">
                            <i class="ri-apple-fill"></i>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Auth modal functionality
    const authModal = document.getElementById('authModal');
    const loginTab = document.getElementById('loginTab');
    const registerTab = document.getElementById('registerTab');
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const closeAuthModal = document.getElementById('closeAuthModal');
    const loginRegisterBtn = document.getElementById('loginRegisterBtn');

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
</script>
@endpush

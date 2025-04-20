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
                <x-footer-menu type="main" />
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Müşteri Desteği</h3>
                <x-footer-menu type="support" />
            </div>
        </div>
        <div class="border-t border-gray-800 pt-8 text-center text-gray-500">
            <p>&copy; 2025 Ürün Öneri Sistemi. Tüm hakları saklıdır.</p>
        </div>
    </div>
</footer> 
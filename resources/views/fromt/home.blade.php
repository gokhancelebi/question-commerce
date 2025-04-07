@extends('fromt.layouts.app')
@section('content')

<main>
    <section class="pt-32 pb-16 px-4 bg-gradient-to-br from-white to-gray-100">
        <div class="container mx-auto max-w-5xl">
            <div class="text-center mb-12">
                <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto">5 basit soruyu yanıtlayın ve
                    ihtiyaçlarınıza uygun ideal ürünü önerelim. Artık sonsuz göz atma yok!</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <!-- Progress Steps -->
                <div class="flex justify-between items-center mb-8 relative">
                    <div class="absolute top-1/2 left-0 right-0 h-0.5 bg-gray-200 -translate-y-1/2">
                        <div class="h-0.5 bg-primary" style="width: 0%"></div>
                    </div>
                    <div class="progress-step relative z-10">
                        <div
                            class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center relative z-10">
                            <span>1</span>
                        </div>
                    </div>
                    <div class="progress-step relative z-10">
                        <div
                            class="w-10 h-10 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center relative z-10">
                            <span>2</span>
                        </div>
                    </div>
                    <div class="progress-step relative z-10">
                        <div
                            class="w-10 h-10 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center relative z-10">
                            <span>3</span>
                        </div>
                    </div>
                    <div class="progress-step relative z-10">
                        <div
                            class="w-10 h-10 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center relative z-10">
                            <span>4</span>
                        </div>
                    </div>
                    <div class="progress-step relative z-10">
                        <div
                            class="w-10 h-10 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center relative z-10">
                            <span>5</span>
                        </div>
                    </div>
                </div>
                <!-- Question Slides -->
                <div id="questionSlider" class="relative overflow-hidden">
                    <!-- Question 1 -->
                    <div class="question-slide active" data-question="1">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6">1. Temel kullanım amacınız nedir?</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <label class="custom-radio block">
                                <input type="radio" name="question1" value="1">
                                <div class="radio-indicator"></div>
                                <div
                                    class="option-card border border-gray-200 rounded p-4 cursor-pointer hover:shadow-md pl-12">
                                    <h4 class="font-medium">Profesyonel İş</h4>
                                </div>
                            </label>
                            <label class="custom-radio block">
                                <input type="radio" name="question1" value="2">
                                <div class="radio-indicator"></div>
                                <div
                                    class="option-card border border-gray-200 rounded p-4 cursor-pointer hover:shadow-md pl-12">
                                    <h4 class="font-medium">Eğlence</h4>
                                </div>
                            </label>
                            <label class="custom-radio block">
                                <input type="radio" name="question1" value="3">
                                <div class="radio-indicator"></div>
                                <div
                                    class="option-card border border-gray-200 rounded p-4 cursor-pointer hover:shadow-md pl-12">
                                    <h4 class="font-medium">Günlük Kullanım</h4>
                                </div>
                            </label>
                            <label class="custom-radio block">
                                <input type="radio" name="question1" value="4">
                                <div class="radio-indicator"></div>
                                <div
                                    class="option-card border border-gray-200 rounded p-4 cursor-pointer hover:shadow-md pl-12">
                                    <h4 class="font-medium">Öğrenci</h4>
                                </div>
                            </label>
                            <label class="custom-radio block">
                                <input type="radio" name="question1" value="5">
                                <div class="radio-indicator"></div>
                                <div
                                    class="option-card border border-gray-200 rounded p-4 cursor-pointer hover:shadow-md pl-12">
                                    <h4 class="font-medium">Yaratıcı İş</h4>
                                </div>
                            </label>
                        </div>
                        <div class="mt-6 flex justify-end">
                            <button
                                class="next-question bg-primary text-white px-6 py-3 !rounded-button hover:bg-opacity-90 transition-all flex items-center whitespace-nowrap">
                                Sonraki Soru
                                <div class="w-5 h-5 ml-2 flex items-center justify-center">
                                    <i class="ri-arrow-right-line"></i>
                                </div>
                            </button>
                        </div>
                    </div>
                    <!-- Question 2 -->
                    <div class="question-slide" data-question="2">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6">2. Bütçe aralığınız nedir?</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <label class="custom-radio block">
                                <input type="radio" name="question2" value="1">
                                <div class="radio-indicator"></div>
                                <div
                                    class="option-card border border-gray-200 rounded p-4 cursor-pointer hover:shadow-md pl-12">
                                    <h4 class="font-medium">Ekonomik (0-5.000 TL)</h4>
                                </div>
                            </label>
                            <label class="custom-radio block">
                                <input type="radio" name="question2" value="2">
                                <div class="radio-indicator"></div>
                                <div
                                    class="option-card border border-gray-200 rounded p-4 cursor-pointer hover:shadow-md pl-12">
                                    <h4 class="font-medium">Orta Seviye (5.000-10.000 TL)</h4>
                                </div>
                            </label>
                            <label class="custom-radio block">
                                <input type="radio" name="question2" value="3">
                                <div class="radio-indicator"></div>
                                <div
                                    class="option-card border border-gray-200 rounded p-4 cursor-pointer hover:shadow-md pl-12">
                                    <h4 class="font-medium">Premium (10.000-15.000 TL)</h4>
                                </div>
                            </label>
                            <label class="custom-radio block">
                                <input type="radio" name="question2" value="4">
                                <div class="radio-indicator"></div>
                                <div
                                    class="option-card border border-gray-200 rounded p-4 cursor-pointer hover:shadow-md pl-12">
                                    <h4 class="font-medium">Lüks (15.000-25.000 TL)</h4>
                                </div>
                            </label>
                            <label class="custom-radio block">
                                <input type="radio" name="question2" value="5">
                                <div class="radio-indicator"></div>
                                <div
                                    class="option-card border border-gray-200 rounded p-4 cursor-pointer hover:shadow-md pl-12">
                                    <h4 class="font-medium">Sınırsız (25.000 TL üzeri)</h4>
                                </div>
                            </label>
                        </div>
                        <div class="mt-6 flex justify-between">
                            <button
                                class="prev-question border border-gray-300 text-gray-700 px-6 py-3 !rounded-button hover:bg-gray-50 transition-all flex items-center whitespace-nowrap">
                                <div class="w-5 h-5 mr-2 flex items-center justify-center">
                                    <i class="ri-arrow-left-line"></i>
                                </div>
                                Önceki
                            </button>
                            <button
                                class="next-question bg-primary text-white px-6 py-3 !rounded-button hover:bg-opacity-90 transition-all flex items-center whitespace-nowrap">
                                Sonraki Soru
                                <div class="w-5 h-5 ml-2 flex items-center justify-center">
                                    <i class="ri-arrow-right-line"></i>
                                </div>
                            </button>
                        </div>
                    </div>
                    <!-- Question 3 -->
                    <div class="question-slide" data-question="3">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6">3. Hangi boyutu tercih edersiniz?</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="custom-radio block">
                                <input type="radio" name="question3" value="1">
                                <div class="radio-indicator"></div>
                                <div
                                    class="option-card border border-gray-200 rounded p-4 cursor-pointer hover:shadow-md pl-12">
                                    <h4 class="font-medium">Kompakt (13\" veya daha küçük)</h4>
                                </div>
                            </label>
                            <label class="custom-radio block">
                                <input type="radio" name="question3" value="2">
                                <div class="radio-indicator"></div>
                                <div
                                    class="option-card border border-gray-200 rounded p-4 cursor-pointer hover:shadow-md pl-12">
                                    <h4 class="font-medium">Orta (14-15\")</h4>
                                </div>
                            </label>
                            <label class="custom-radio block">
                                <input type="radio" name="question3" value="3">
                                <div class="radio-indicator"></div>
                                <div
                                    class="option-card border border-gray-200 rounded p-4 cursor-pointer hover:shadow-md pl-12">
                                    <h4 class="font-medium">Büyük (16-17\")</h4>
                                </div>
                            </label>
                            <label class="custom-radio block">
                                <input type="radio" name="question3" value="4">
                                <div class="radio-indicator"></div>
                                <div
                                    class="option-card border border-gray-200 rounded p-4 cursor-pointer hover:shadow-md pl-12">
                                    <h4 class="font-medium">Ekstra Büyük (17\"+ veya Masaüstü)</h4>
                                </div>
                            </label>
                        </div>
                        <div class="mt-6 flex justify-between">
                            <button
                                class="prev-question border border-gray-300 text-gray-700 px-6 py-3 !rounded-button hover:bg-gray-50 transition-all flex items-center whitespace-nowrap">
                                <div class="w-5 h-5 mr-2 flex items-center justify-center">
                                    <i class="ri-arrow-left-line"></i>
                                </div>
                                Önceki
                            </button>
                            <button
                                class="next-question bg-primary text-white px-6 py-3 !rounded-button hover:bg-opacity-90 transition-all flex items-center whitespace-nowrap">
                                Sonraki Soru
                                <div class="w-5 h-5 ml-2 flex items-center justify-center">
                                    <i class="ri-arrow-right-line"></i>
                                </div>
                            </button>
                        </div>
                    </div>
                    <!-- Question 4 -->
                    <div class="question-slide" data-question="4">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6">4. Sizin için en önemli özellikler
                            hangileri?</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <label class="custom-radio block">
                                <input type="radio" name="question4" value="1">
                                <div class="radio-indicator"></div>
                                <div
                                    class="option-card border border-gray-200 rounded p-4 cursor-pointer hover:shadow-md pl-12">
                                    <h4 class="font-medium">Performans</h4>
                                </div>
                            </label>
                            <label class="custom-radio block">
                                <input type="radio" name="question4" value="2">
                                <div class="radio-indicator"></div>
                                <div
                                    class="option-card border border-gray-200 rounded p-4 cursor-pointer hover:shadow-md pl-12">
                                    <h4 class="font-medium">Pil Ömrü</h4>
                                </div>
                            </label>
                            <label class="custom-radio block">
                                <input type="radio" name="question4" value="3">
                                <div class="radio-indicator"></div>
                                <div
                                    class="option-card border border-gray-200 rounded p-4 cursor-pointer hover:shadow-md pl-12">
                                    <h4 class="font-medium">Ekran Kalitesi</h4>
                                </div>
                            </label>
                            <label class="custom-radio block">
                                <input type="radio" name="question4" value="4">
                                <div class="radio-indicator"></div>
                                <div
                                    class="option-card border border-gray-200 rounded p-4 cursor-pointer hover:shadow-md pl-12">
                                    <h4 class="font-medium">Depolama Kapasitesi</h4>
                                </div>
                            </label>
                            <label class="custom-radio block">
                                <input type="radio" name="question4" value="5">
                                <div class="radio-indicator"></div>
                                <div
                                    class="option-card border border-gray-200 rounded p-4 cursor-pointer hover:shadow-md pl-12">
                                    <h4 class="font-medium">Grafik Kapasitesi</h4>
                                </div>
                            </label>
                        </div>
                        <div class="mt-6 flex justify-between">
                            <button
                                class="prev-question border border-gray-300 text-gray-700 px-6 py-3 !rounded-button hover:bg-gray-50 transition-all flex items-center whitespace-nowrap">
                                <div class="w-5 h-5 mr-2 flex items-center justify-center">
                                    <i class="ri-arrow-left-line"></i>
                                </div>
                                Önceki
                            </button>
                            <button
                                class="next-question bg-primary text-white px-6 py-3 !rounded-button hover:bg-opacity-90 transition-all flex items-center whitespace-nowrap">
                                Sonraki Soru
                                <div class="w-5 h-5 ml-2 flex items-center justify-center">
                                    <i class="ri-arrow-right-line"></i>
                                </div>
                            </button>
                        </div>
                    </div>
                    <!-- Question 5 -->
                    <div class="question-slide" data-question="5">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6">5. Ne kadar acil ihtiyacınız var?</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="custom-radio block">
                                <input type="radio" name="question5" value="1">
                                <div class="radio-indicator"></div>
                                <div
                                    class="option-card border border-gray-200 rounded p-4 cursor-pointer hover:shadow-md pl-12">
                                    <h4 class="font-medium">Acil (1-2 gün)</h4>
                                </div>
                            </label>
                            <label class="custom-radio block">
                                <input type="radio" name="question5" value="2">
                                <div class="radio-indicator"></div>
                                <div
                                    class="option-card border border-gray-200 rounded p-4 cursor-pointer hover:shadow-md pl-12">
                                    <h4 class="font-medium">Bir hafta içinde</h4>
                                </div>
                            </label>
                            <label class="custom-radio block">
                                <input type="radio" name="question5" value="3">
                                <div class="radio-indicator"></div>
                                <div
                                    class="option-card border border-gray-200 rounded p-4 cursor-pointer hover:shadow-md pl-12">
                                    <h4 class="font-medium">2 hafta içinde</h4>
                                </div>
                            </label>
                            <label class="custom-radio block">
                                <input type="radio" name="question5" value="4">
                                <div class="radio-indicator"></div>
                                <div
                                    class="option-card border border-gray-200 rounded p-4 cursor-pointer hover:shadow-md pl-12">
                                    <h4 class="font-medium">Acele yok</h4>
                                </div>
                            </label>
                        </div>
                        <div class="mt-6 flex justify-between">
                            <button
                                class="prev-question border border-gray-300 text-gray-700 px-6 py-3 !rounded-button hover:bg-gray-50 transition-all flex items-center whitespace-nowrap">
                                <div class="w-5 h-5 mr-2 flex items-center justify-center">
                                    <i class="ri-arrow-left-line"></i>
                                </div>
                                Önceki
                            </button>
                            <button id="showResultsBtn"
                                class="bg-primary text-white px-6 py-3 !rounded-button hover:bg-opacity-90 transition-all flex items-center whitespace-nowrap">
                                Sonuçları Göster
                                <div class="w-5 h-5 ml-2 flex items-center justify-center">
                                    <i class="ri-arrow-right-line"></i>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product Recommendation (initially hidden) -->
            <div id="productRecommendation" class="hidden mt-8">
                <h3 class="text-2xl font-bold text-center mb-6">Mükemmel Eşleşmeniz</h3>
                <div class="bg-white rounded-lg overflow-hidden shadow-lg transition-all hover:shadow-xl">
                    <div class="aspect-w-16 aspect-h-9 relative h-64">
                        <img src="https://public.readdy.ai/ai/img_res/40f576fd9d3d86c9800aae87faf61a0c.jpg"
                            alt="Premium Laptop" class="w-full h-full object-cover object-top">
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <h4 class="text-xl font-bold">UltraBook Pro X15</h4>
                            <span class="text-xl font-bold text-primary">12.999,99 TL</span>
                        </div>
                        <p class="text-gray-600 mb-6">UltraBook Pro X15, muhteşem 15.6" 4K ekran, güçlü Intel Core
                            i7 işlemci, 16GB RAM ve 1TB SSD depolama özelliklerine sahiptir. 12 saate kadar pil ömrü
                            ve premium alüminyum tasarımı ile profesyonel iş için mükemmeldir.</p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <button
                                class="bg-primary text-white px-6 py-3 !rounded-button hover:bg-opacity-90 transition-all flex-1 whitespace-nowrap flex items-center justify-center">
                                <div class="w-5 h-5 mr-2 flex items-center justify-center">
                                    <i class="ri-shopping-cart-line"></i>
                                </div>
                                Sepete Ekle
                            </button>
                            <button
                                class="border border-primary text-primary px-6 py-3 !rounded-button hover:bg-primary hover:bg-opacity-5 transition-all flex-1 whitespace-nowrap flex items-center justify-center">
                                Alışverişe Devam Et
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Similar Products Section -->
                <div class="mt-12">
                    <h3 class="text-2xl font-bold mb-6">Benzer Ürünler</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Similar Product 1 -->
                        <div class="bg-white rounded-lg overflow-hidden shadow-md transition-all hover:shadow-lg">
                            <div class="aspect-w-16 aspect-h-9 relative h-48">
                                <img src="https://public.readdy.ai/ai/img_res/0f9912ba37ee3fbc9a4d3fb954871768.jpg"
                                    alt="Similar Laptop 1" class="w-full h-full object-cover object-top">
                            </div>
                            <div class="p-4">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="font-bold">ProBook Elite 14</h4>
                                    <span class="font-bold text-primary">9.499,99 TL</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-4">14" FHD ekran, Intel Core i5, 8GB RAM, 512GB
                                    SSD</p>
                                <button
                                    class="w-full bg-primary bg-opacity-10 text-primary px-4 py-2 !rounded-button hover:bg-opacity-20 transition-all whitespace-nowrap flex items-center justify-center">
                                    <div class="w-4 h-4 mr-2 flex items-center justify-center">
                                        <i class="ri-eye-line"></i>
                                    </div>
                                    Ürünü İncele
                                </button>
                            </div>
                        </div>
                        <!-- Similar Product 2 -->
                        <div class="bg-white rounded-lg overflow-hidden shadow-md transition-all hover:shadow-lg">
                            <div class="aspect-w-16 aspect-h-9 relative h-48">
                                <img src="https://public.readdy.ai/ai/img_res/7d2f689eb2623d742ced67ca234f0dce.jpg"
                                    alt="Similar Laptop 2" class="w-full h-full object-cover object-top">
                            </div>
                            <div class="p-4">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="font-bold">UltraSlim 15</h4>
                                    <span class="font-bold text-primary">14.299,99 TL</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-4">15.6" 4K OLED, Intel Core i7, 16GB RAM, 1TB
                                    SSD</p>
                                <button
                                    class="w-full bg-primary bg-opacity-10 text-primary px-4 py-2 !rounded-button hover:bg-opacity-20 transition-all whitespace-nowrap flex items-center justify-center">
                                    <div class="w-4 h-4 mr-2 flex items-center justify-center">
                                        <i class="ri-eye-line"></i>
                                    </div>
                                    Ürünü İncele
                                </button>
                            </div>
                        </div>
                        <!-- Similar Product 3 -->
                        <div class="bg-white rounded-lg overflow-hidden shadow-md transition-all hover:shadow-lg">
                            <div class="aspect-w-16 aspect-h-9 relative h-48">
                                <img src="https://public.readdy.ai/ai/img_res/cdb8a35fee12f29f01976897daf138aa.jpg"
                                    alt="Similar Laptop 3" class="w-full h-full object-cover object-top">
                            </div>
                            <div class="p-4">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="font-bold">PowerBook Pro 16</h4>
                                    <span class="font-bold text-primary">16.799,99 TL</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-4">16" QHD+, Intel Core i9, 32GB RAM, 2TB SSD
                                </p>
                                <button
                                    class="w-full bg-primary bg-opacity-10 text-primary px-4 py-2 !rounded-button hover:bg-opacity-20 transition-all whitespace-nowrap flex items-center justify-center">
                                    <div class="w-4 h-4 mr-2 flex items-center justify-center">
                                        <i class="ri-eye-line"></i>
                                    </div>
                                    Ürünü İncele
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</main>

@endsection
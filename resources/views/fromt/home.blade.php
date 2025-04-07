@extends('fromt.layouts.app')
@section('content')

<main>
    <section class="pt-32 pb-16 px-4 bg-gradient-to-br from-white to-gray-100">
        <div class="container mx-auto max-w-5xl">
            <div class="text-center mb-12">
                <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto">5 basit soruyu yanıtlayın ve  ideal ürünü önerelim. </p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <!-- Progress Steps -->
                <div class="flex justify-between items-center mb-8 relative">
                    <div class="absolute top-1/2 left-0 right-0 h-0.5 bg-gray-200 -translate-y-1/2">
                        <div class="h-0.5 bg-primary" id="progressBar" style="width: 0%"></div>
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
            </div>
        </div>
    </section>


</main>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Override the global updateProgressIndicator function
    window.updateProgressIndicator = function(currentStep) {
        // Update the progress bar directly using the ID
        const progressBar = document.getElementById('progressBar');
        if (progressBar) {
            const width = (currentStep - 1) * 25;
            progressBar.style.width = `${width}%`;
        }

        const progressSteps = document.querySelectorAll('.progress-step');
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
    };

    // Initialize first question
    showQuestionSlide(1);

    // Function to show a question slide
    function showQuestionSlide(slideNumber) {
        const questionSlides = document.querySelectorAll('.question-slide');

        questionSlides.forEach((slide) => {
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
        slide.appendChild(errorMsg);

        // Remove the error message after 3 seconds
        setTimeout(() => {
            errorMsg.remove();
        }, 3000);
    }

    // Add event listeners to next buttons
    document.querySelectorAll('.next-question').forEach(button => {
        button.addEventListener('click', function() {
            const slide = this.closest('.question-slide');
            const questionNumber = parseInt(slide.getAttribute('data-question'));
            const selectedOption = document.querySelector(`input[name="question${questionNumber}"]:checked`);

            // Check if an option is selected
            if (!selectedOption) {
                showErrorMessage(slide, 'Lütfen devam etmek için bir seçenek belirleyin.');
                return;
            }

            // Show next question
            showQuestionSlide(questionNumber + 1);
        });
    });

    // Add event listeners to previous buttons
    document.querySelectorAll('.prev-question').forEach(button => {
        button.addEventListener('click', function() {
            const slide = this.closest('.question-slide');
            const questionNumber = parseInt(slide.getAttribute('data-question'));
            showQuestionSlide(questionNumber - 1);
        });
    });

    // Add event listener to show results button
    document.getElementById('showResultsBtn').addEventListener('click', function() {
        const slide = this.closest('.question-slide');
        const questionNumber = parseInt(slide.getAttribute('data-question'));
        const selectedOption = document.querySelector(`input[name="question${questionNumber}"]:checked`);

        // Check if an option is selected
        if (!selectedOption) {
            showErrorMessage(slide, 'Lütfen devam etmek için bir seçenek belirleyin.');
            return;
        }

        // Show loading indicator
        const loadingIndicator = document.createElement('div');
        loadingIndicator.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
        loadingIndicator.innerHTML = `
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <div class="w-16 h-16 border-4 border-primary border-t-transparent rounded-full animate-spin mx-auto mb-4"></div>
                <p class="text-lg font-medium">Mükemmel eşleşmeniz bulunuyor...</p>
            </div>
        `;
        document.body.appendChild(loadingIndicator);

        // Simulate API call with a timeout
        setTimeout(() => {
            // Remove loading indicator
            document.body.removeChild(loadingIndicator);

            // Show product recommendation
            document.getElementById('productRecommendation').classList.remove('hidden');

            // Scroll to the recommendation
            document.getElementById('productRecommendation').scrollIntoView({
                behavior: 'smooth'
            });

            // Update progress indicator to show completion
            updateProgressIndicator(5);
        }, 1500);
    });
});
</script>
@endpush

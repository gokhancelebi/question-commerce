@extends('front.layouts.app')
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
                    @foreach($questions as $index => $question)
                    <div class="progress-step relative z-10">
                        <div class="w-10 h-10 rounded-full {{ $index === 0 ? 'bg-primary text-white' : 'bg-gray-200 text-gray-600' }} flex items-center justify-center relative z-10">
                            <span>{{ $index + 1 }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Question Slides -->
                <div id="questionSlider" class="relative overflow-hidden">
                    @foreach($questions as $index => $question)
                    <div class="question-slide {{ $index === 0 ? 'active' : '' }}" data-question="{{ $index + 1 }}">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6">{{ $index + 1 }}. {{ $question->title }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach($question->answers as $answer)
                            <label class="custom-radio block">
                                <input type="radio" name="question{{ $index + 1 }}" value="{{ $answer->id }}">
                                <div class="radio-indicator"></div>
                                <div class="option-card border border-gray-200 rounded p-4 cursor-pointer hover:shadow-md pl-12">
                                    <h4 class="font-medium">{{ $answer->content }}</h4>
                                </div>
                            </label>
                            @endforeach
                        </div>
                        <div class="mt-6 flex {{ $index > 0 ? 'justify-between' : 'justify-end' }}">
                            @if($index > 0)
                            <button class="prev-question border border-gray-300 text-gray-700 px-6 py-3 !rounded-button hover:bg-gray-50 transition-all flex items-center whitespace-nowrap">
                                <div class="w-5 h-5 mr-2 flex items-center justify-center">
                                    <i class="ri-arrow-left-line"></i>
                                </div>
                                Önceki
                            </button>
                            @endif
                            @if($index < count($questions) - 1)
                            <button class="next-question bg-primary text-white px-6 py-3 !rounded-button hover:bg-opacity-90 transition-all flex items-center whitespace-nowrap">
                                Sonraki Soru
                                <div class="w-5 h-5 ml-2 flex items-center justify-center">
                                    <i class="ri-arrow-right-line"></i>
                                </div>
                            </button>
                            @else
                            <button id="showResultsBtn" class="bg-primary text-white px-6 py-3 !rounded-button hover:bg-opacity-90 transition-all flex items-center whitespace-nowrap">
                                Sonuçları Göster
                                <div class="w-5 h-5 ml-2 flex items-center justify-center">
                                    <i class="ri-arrow-right-line"></i>
                                </div>
                            </button>
                            @endif
                        </div>
                    </div>
                    @endforeach
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

        // Collect all answers
        const answers = {};
        document.querySelectorAll('input[type="radio"]:checked').forEach(radio => {
            answers[radio.name] = radio.value;
        });

        // Show loading indicator
        const loadingIndicator = document.createElement('div');
        loadingIndicator.id = 'loadingIndicator';  // Add an ID for easier removal
        loadingIndicator.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
        loadingIndicator.innerHTML = `
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <div class="w-16 h-16 border-4 border-primary border-t-transparent rounded-full animate-spin mx-auto mb-4"></div>
                <p class="text-lg font-medium">Mükemmel eşleşmeniz bulunuyor...</p>
            </div>
        `;
        document.body.appendChild(loadingIndicator);

        // Hide the question form
        const questionForm = document.querySelector('.bg-white.rounded-lg.shadow-md.p-6.mb-8');
        if (questionForm) {
            questionForm.style.display = 'none';
        }

        // Function to remove loading indicator
        const removeLoadingIndicator = () => {
            const indicator = document.getElementById('loadingIndicator');
            if (indicator) {
                indicator.remove();
            }
        };

        // Make AJAX call to process survey
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        fetch('/survey/process', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken || '',
                'Accept': 'application/json'
            },
            body: JSON.stringify(answers)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Remove loading indicator
            removeLoadingIndicator();

            if (data.success && data.products && data.products.length > 0) {
                // Get the first (best) match
                const bestMatch = data.products[0];

                // Update the product recommendation HTML
                const productRecommendation = document.getElementById('productRecommendation');
                productRecommendation.innerHTML = `
                    <h3 class="text-2xl font-bold text-center mb-6">Mükemmel Eşleşmeniz</h3>
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg transition-all hover:shadow-xl">
                        <div class="aspect-w-16 aspect-h-9 relative h-64 p-6">
                            <img src="${bestMatch.image || 'https://via.placeholder.com/800x600'}"
                                alt="${bestMatch.name}"
                                class="w-full h-full object-contain">
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <h4 class="text-xl font-bold">${bestMatch.name}</h4>
                                <span class="text-xl font-bold text-primary">${Number(bestMatch.price).toLocaleString('tr-TR', { minimumFractionDigits: 2 })} TL</span>
                            </div>
                            <p class="text-gray-600 mb-6">${bestMatch.description || ''}</p>
                            <div class="flex flex-col sm:flex-row gap-4">
                                ${bestMatch.external_url ? `
                                    <a href="${bestMatch.external_url}" target="_blank"
                                        class="bg-primary text-white px-6 py-3 !rounded-button hover:bg-opacity-90 transition-all flex-1 whitespace-nowrap flex items-center justify-center">
                                        <div class="w-5 h-5 mr-2 flex items-center justify-center">
                                            <i class="ri-shopping-cart-line"></i>
                                        </div>
                                        Satın Al
                                    </a>
                                ` : `
                                    <button class="bg-primary text-white px-6 py-3 !rounded-button hover:bg-opacity-90 transition-all flex-1 whitespace-nowrap flex items-center justify-center">
                                        <div class="w-5 h-5 mr-2 flex items-center justify-center">
                                            <i class="ri-shopping-cart-line"></i>
                                        </div>
                                        Sepete Ekle
                                    </button>
                                `}
                                <button onclick="window.location.reload()"
                                    class="border border-primary text-primary px-6 py-3 !rounded-button hover:bg-primary hover:bg-opacity-5 transition-all flex-1 whitespace-nowrap flex items-center justify-center">
                                    Yeni Test Başlat
                                </button>
                            </div>
                        </div>
                    </div>
                `;

                // Show the recommendation
                productRecommendation.classList.remove('hidden');
                productRecommendation.scrollIntoView({ behavior: 'smooth' });
            } else {
                const productRecommendation = document.getElementById('productRecommendation');
                productRecommendation.innerHTML = `
                    <div class="text-center p-8 bg-white rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Üzgünüz!</h3>
                        <p class="text-gray-600">Şu anda kriterlere uygun bir ürün bulamadık.</p>
                        <button onclick="window.location.reload()"
                            class="mt-6 bg-primary text-white px-6 py-3 !rounded-button hover:bg-opacity-90 transition-all">
                            Tekrar Deneyin
                        </button>
                    </div>
                `;
                productRecommendation.classList.remove('hidden');
                productRecommendation.scrollIntoView({ behavior: 'smooth' });
            }

            // Update progress indicator to show completion
            updateProgressIndicator(5);
        })
        .catch(error => {
            console.error('Error:', error);
            // Remove loading indicator
            removeLoadingIndicator();

            // Show error message
            showErrorMessage(slide, 'Bir hata oluştu. Lütfen tekrar deneyin.');

            // Show the form again
            if (questionForm) {
                questionForm.style.display = 'block';
            }
        })
        .finally(() => {
            // Ensure loading indicator is removed even if something goes wrong
            removeLoadingIndicator();
        });
    });
});
</script>
@endpush

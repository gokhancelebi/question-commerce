@extends('fromt.layouts.app')

@section('title', 'Ürün Öneri Sistemi')

@section('styles')
<style>
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[type="number"] {
        -moz-appearance: textfield;
    }
    .progress-step {
        position: relative;
        z-index: 1;
    }
    .question-slide {
        position: absolute;
        width: 100%;
        opacity: 0;
        transform: translateX(50px);
        transition: all 0.5s ease;
        pointer-events: none;
    }
    .question-slide.active {
        position: relative;
        opacity: 1;
        transform: translateX(0);
        pointer-events: auto;
    }
    .question-slide.prev {
        transform: translateX(-50px);
    }
    .custom-radio {
        position: relative;
    }
    .custom-radio input[type="radio"] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }
    .custom-radio .radio-indicator {
        position: absolute;
        top: 1rem;
        left: 1rem;
        height: 24px;
        width: 24px;
        background-color: #fff;
        border: 2px solid #e2e8f0;
        border-radius: 50%;
        transition: all 0.2s ease;
    }
    .custom-radio input[type="radio"]:checked ~ .radio-indicator {
        background-color: #fff;
        border-color: #E37D10;
    }
    .custom-radio input[type="radio"]:checked ~ .radio-indicator:after {
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #E37D10;
    }
    .custom-radio input[type="radio"]:checked ~ .option-card {
        border-color: #E37D10;
        background-color: rgba(227, 125, 16, 0.05);
    }
    .option-card {
        transition: all 0.2s ease;
        position: relative;
        z-index: 1;
    }
    .option-card:hover {
        background-color: rgba(227, 125, 16, 0.03);
        z-index: 2;
    }
    #questionSlider {
        min-height: 350px;
        position: relative;
        overflow: hidden;
    }

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
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-primary to-primary-dark text-white py-20">
    <div class="container mx-auto max-w-6xl px-4">
        <div class="text-center max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Mükemmel Ürününüzü Bulun</h1>
            <p class="text-lg md:text-xl mb-8 opacity-90">5 basit soruyla size en uygun ürünü bulalım. Artık saatlerce araştırma yapmanıza gerek yok!</p>
            <button id="startSurveyBtn" class="bg-white text-primary px-8 py-4 rounded-button text-lg font-semibold hover:bg-opacity-90 transition-all">
                Ankete Başla
            </button>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-auto">
            <path fill="#ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</section>

<!-- How It Works -->
@include('fromt.partials.how-it-works')

<!-- Survey Section -->
<section id="surveySection" class="py-16 px-4 bg-white hidden">
    <div class="container mx-auto max-w-4xl">
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            @include('fromt.partials.survey-questions')
        </div>
    </div>
</section>

<!-- Product Recommendations -->
<section id="recommendationSection" class="py-16 px-4 bg-gray-50 hidden">
    <div class="container mx-auto max-w-4xl">
        @include('fromt.partials.product-recommendation')
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const startSurveyBtn = document.getElementById('startSurveyBtn');
    const surveySection = document.getElementById('surveySection');
    const recommendationSection = document.getElementById('recommendationSection');
    const progressBar = document.getElementById('progressBar');

    // User answers
    const userAnswers = {
        question1: null,
        question2: null,
        question3: null,
        question4: null,
        question5: null
    };

    // Show survey section when start button is clicked
    startSurveyBtn.addEventListener('click', function() {
        surveySection.classList.remove('hidden');
        window.scrollTo({
            top: surveySection.offsetTop - 100,
            behavior: 'smooth'
        });
    });

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

    // Function to update progress indicator
    function updateProgressIndicator(currentStep) {
        // Update the progress bar
        const width = (currentStep - 1) * 25;
        progressBar.style.width = `${width}%`;

        document.querySelectorAll('.progress-step').forEach((step, index) => {
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
        document.querySelectorAll('.question-slide').forEach((slide, index) => {
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

    // Add event listeners to radio buttons
    document.querySelectorAll('.custom-radio input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const questionNumber = this.name.replace('question', '');
            userAnswers[this.name] = this.value;
        });
    });

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

            // Store the answer
            userAnswers[`question${questionNumber}`] = selectedOption.value;

            // Show next question
            const nextQuestionNumber = questionNumber + 1;
            showQuestionSlide(nextQuestionNumber);
        });
    });

    // Add event listeners to previous buttons
    document.querySelectorAll('.prev-question').forEach(button => {
        button.addEventListener('click', function() {
            const slide = this.closest('.question-slide');
            const questionNumber = parseInt(slide.getAttribute('data-question'));

            // Show previous question
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

        // Store the answer
        userAnswers[`question${questionNumber}`] = selectedOption.value;

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

        // Send the answers to the backend
        fetch('{{ route('survey.process') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(userAnswers)
        })
        .then(response => response.json())
        .then(data => {
            // Remove loading indicator
            document.body.removeChild(loadingIndicator);

            // Show product recommendation
            recommendationSection.classList.remove('hidden');

            // Scroll to the recommendation
            window.scrollTo({
                top: recommendationSection.offsetTop - 100,
                behavior: 'smooth'
            });

            // Update progress indicator to show completion
            updateProgressIndicator(5);

            // Trigger custom event for survey completion
            window.dispatchEvent(new CustomEvent('surveyCompleted'));
        })
        .catch(error => {
            // Remove loading indicator
            document.body.removeChild(loadingIndicator);
            console.error('Error:', error);

            // Show error notification
            showNotification('Bir hata oluştu. Lütfen tekrar deneyin.', 'error');
        });
    });

    // Initialize the first question as active if survey section is visible
    if (!surveySection.classList.contains('hidden')) {
        showQuestionSlide(1);
    }
});
</script>
@endpush

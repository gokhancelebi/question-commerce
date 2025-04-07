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
        @include('fromt.partials.survey-questions')
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

    startSurveyBtn.addEventListener('click', function() {
        window.scrollTo({
            top: surveySection.offsetTop - 100,
            behavior: 'smooth'
        });
        surveySection.classList.remove('hidden');
    });

    // Listen for survey completion event
    window.addEventListener('surveyCompleted', function() {
        recommendationSection.classList.remove('hidden');
        window.scrollTo({
            top: recommendationSection.offsetTop - 100,
            behavior: 'smooth'
        });
    });
});
</script>
@endpush

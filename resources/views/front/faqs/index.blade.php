@extends('front.layouts.app')

@section('title', 'Sık Sorulan Sorular')
@section('meta_description', 'Question Commerce SSS. Sık sorulan sorular ve yanıtları.')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4 text-3xl font-bold text-center text-gray-800">Sık Sorulan Sorular</h1>
            
            @php
                // Group FAQs by categories based on their order
                $generalFaqs = $faqs->filter(function($faq) { return $faq->order <= 2; });
                $shippingFaqs = $faqs->filter(function($faq) { return $faq->order >= 3 && $faq->order <= 4; });
                $returnFaqs = $faqs->filter(function($faq) { return $faq->order >= 5 && $faq->order <= 6; });
                $accountFaqs = $faqs->filter(function($faq) { return $faq->order >= 7 && $faq->order <= 8; });
                $paymentFaqs = $faqs->filter(function($faq) { return $faq->order >= 9; });
            @endphp
            
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">Genel Sorular</h2>
                <div class="accordion" id="generalAccordion">
                    @forelse($generalFaqs as $index => $faq)
                        <div class="accordion-item bg-white border border-gray-200 rounded-lg mb-2 overflow-hidden">
                            <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }} p-4 w-full text-left font-medium text-gray-700 hover:bg-gray-50 focus:outline-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $faq->id }}">
                                    {{ $faq->question }}
                                </button>
                            </h2>
                            <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#generalAccordion">
                                <div class="accordion-body p-4 bg-gray-50">
                                    {!! $faq->answer !!}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-gray-500">Bu kategoride henüz soru bulunmamaktadır.</div>
                    @endforelse
                </div>
            </div>
            
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">Kargo ve Teslimat</h2>
                <div class="accordion" id="shippingAccordion">
                    @forelse($shippingFaqs as $index => $faq)
                        <div class="accordion-item bg-white border border-gray-200 rounded-lg mb-2 overflow-hidden">
                            <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                <button class="accordion-button collapsed p-4 w-full text-left font-medium text-gray-700 hover:bg-gray-50 focus:outline-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false" aria-controls="collapse{{ $faq->id }}">
                                    {{ $faq->question }}
                                </button>
                            </h2>
                            <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#shippingAccordion">
                                <div class="accordion-body p-4 bg-gray-50">
                                    {!! $faq->answer !!}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-gray-500">Bu kategoride henüz soru bulunmamaktadır.</div>
                    @endforelse
                </div>
            </div>
            
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">İade ve Geri Ödeme</h2>
                <div class="accordion" id="returnAccordion">
                    @forelse($returnFaqs as $index => $faq)
                        <div class="accordion-item bg-white border border-gray-200 rounded-lg mb-2 overflow-hidden">
                            <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                <button class="accordion-button collapsed p-4 w-full text-left font-medium text-gray-700 hover:bg-gray-50 focus:outline-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false" aria-controls="collapse{{ $faq->id }}">
                                    {{ $faq->question }}
                                </button>
                            </h2>
                            <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#returnAccordion">
                                <div class="accordion-body p-4 bg-gray-50">
                                    {!! $faq->answer !!}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-gray-500">Bu kategoride henüz soru bulunmamaktadır.</div>
                    @endforelse
                </div>
            </div>
            
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">Hesap</h2>
                <div class="accordion" id="accountAccordion">
                    @forelse($accountFaqs as $index => $faq)
                        <div class="accordion-item bg-white border border-gray-200 rounded-lg mb-2 overflow-hidden">
                            <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                <button class="accordion-button collapsed p-4 w-full text-left font-medium text-gray-700 hover:bg-gray-50 focus:outline-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false" aria-controls="collapse{{ $faq->id }}">
                                    {{ $faq->question }}
                                </button>
                            </h2>
                            <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#accountAccordion">
                                <div class="accordion-body p-4 bg-gray-50">
                                    {!! $faq->answer !!}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-gray-500">Bu kategoride henüz soru bulunmamaktadır.</div>
                    @endforelse
                </div>
            </div>
            
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">Ödeme</h2>
                <div class="accordion" id="paymentAccordion">
                    @forelse($paymentFaqs as $index => $faq)
                        <div class="accordion-item bg-white border border-gray-200 rounded-lg mb-2 overflow-hidden">
                            <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                <button class="accordion-button collapsed p-4 w-full text-left font-medium text-gray-700 hover:bg-gray-50 focus:outline-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false" aria-controls="collapse{{ $faq->id }}">
                                    {{ $faq->question }}
                                </button>
                            </h2>
                            <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#paymentAccordion">
                                <div class="accordion-body p-4 bg-gray-50">
                                    {!! $faq->answer !!}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-gray-500">Bu kategoride henüz soru bulunmamaktadır.</div>
                    @endforelse
                </div>
            </div>
            
            <div class="mt-12 text-center bg-gray-50 p-8 rounded-lg">
                <h3 class="text-2xl font-semibold mb-3">Sorunuzu bulamadınız mı?</h3>
                <p class="mb-6 text-gray-600">İhtiyaç duyduğunuz cevabı bulamadıysanız, lütfen bizimle iletişime geçin.</p>
                <a href="{{ route('pages.show', 'iletisim') }}" class="bg-primary hover:bg-primary-dark text-white px-8 py-3 rounded-md transition-colors inline-block">
                    İletişime Geçin
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add custom accordion functionality if needed
        const accordionButtons = document.querySelectorAll('.accordion-button');
        
        accordionButtons.forEach(button => {
            button.addEventListener('click', function() {
                const isExpanded = this.getAttribute('aria-expanded') === 'true';
                this.setAttribute('aria-expanded', !isExpanded);
                
                const target = document.querySelector(this.getAttribute('data-bs-target'));
                if (target) {
                    if (isExpanded) {
                        target.classList.remove('show');
                    } else {
                        target.classList.add('show');
                    }
                }
            });
        });
    });
</script>
@endpush
@endsection 
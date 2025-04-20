@extends('front.layouts.app')

@section('title', 'Sık Sorulan Sorular')
@section('meta_description', 'Question Commerce SSS. Sık sorulan sorular ve yanıtları.')

@section('content')
<div class="container mx-auto max-w-5xl px-4 py-16">
    <!-- Page Header -->
    <div class="mb-12 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Sık Sorulan Sorular</h1>
        <p class="text-gray-600 max-w-3xl mx-auto">Müşterilerimizin en çok sorduğu soruları ve yanıtlarını aşağıda bulabilirsiniz. Aradığınız bilgiyi bulamazsanız bizimle iletişime geçebilirsiniz.</p>
    </div>
    
    <!-- FAQ Categories -->
    <div class="grid gap-8 mb-16">
        @php
            // Group FAQs by categories based on their order
            $generalFaqs = $faqs->filter(function($faq) { return $faq->order <= 2; });
            $shippingFaqs = $faqs->filter(function($faq) { return $faq->order >= 3 && $faq->order <= 4; });
            $returnFaqs = $faqs->filter(function($faq) { return $faq->order >= 5 && $faq->order <= 6; });
            $accountFaqs = $faqs->filter(function($faq) { return $faq->order >= 7 && $faq->order <= 8; });
            $paymentFaqs = $faqs->filter(function($faq) { return $faq->order >= 9; });
        @endphp
        
        <!-- Category: General Questions -->
        <div class="bg-white rounded-xl shadow-sm">
            <div class="bg-primary/10 px-6 py-4">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <i class="ri-information-line mr-3 text-primary text-2xl"></i>
                    Genel Sorular
                </h2>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($generalFaqs as $index => $faq)
                    <div class="faq-item" x-data="{ open: {{ $index === 0 ? 'true' : 'false' }} }">
                        <button 
                            class="w-full py-5 px-6 flex justify-between items-center text-left hover:bg-gray-50 transition-colors focus:outline-none group"
                            @click="open = !open"
                        >
                            <span class="font-medium text-gray-900 text-base md:text-lg group-hover:text-primary transition-colors">{{ $faq->question }}</span>
                            <span class="ml-4 flex-shrink-0 flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 group-hover:bg-primary/10 transition-colors">
                                <i class="ri-arrow-down-s-line text-lg text-gray-500 group-hover:text-primary transition-transform duration-300" :class="{'rotate-180': open}"></i>
                            </span>
                        </button>
                        <div 
                            class="overflow-hidden transition-all duration-300 max-h-0 bg-gray-50/50"
                            x-ref="content"
                            :style="open ? 'max-height: ' + $refs.content.scrollHeight + 'px' : 'max-height: 0px'"
                        >
                            <div class="p-6 prose prose-sm max-w-none">
                                {!! $faq->answer !!}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-4 text-gray-500 italic">Bu kategoride henüz soru bulunmamaktadır.</div>
                @endforelse
            </div>
        </div>

        <!-- Category: Shipping Questions -->
        <div class="bg-white rounded-xl shadow-sm">
            <div class="bg-primary/10 px-6 py-4">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <i class="ri-truck-line mr-3 text-primary text-2xl"></i>
                    Kargo ve Teslimat
                </h2>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($shippingFaqs as $index => $faq)
                    <div class="faq-item" x-data="{ open: false }">
                        <button 
                            class="w-full py-5 px-6 flex justify-between items-center text-left hover:bg-gray-50 transition-colors focus:outline-none group"
                            @click="open = !open"
                        >
                            <span class="font-medium text-gray-900 text-base md:text-lg group-hover:text-primary transition-colors">{{ $faq->question }}</span>
                            <span class="ml-4 flex-shrink-0 flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 group-hover:bg-primary/10 transition-colors">
                                <i class="ri-arrow-down-s-line text-lg text-gray-500 group-hover:text-primary transition-transform duration-300" :class="{'rotate-180': open}"></i>
                            </span>
                        </button>
                        <div 
                            class="overflow-hidden transition-all duration-300 max-h-0 bg-gray-50/50"
                            x-ref="content"
                            :style="open ? 'max-height: ' + $refs.content.scrollHeight + 'px' : 'max-height: 0px'"
                        >
                            <div class="p-6 prose prose-sm max-w-none">
                                {!! $faq->answer !!}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-4 text-gray-500 italic">Bu kategoride henüz soru bulunmamaktadır.</div>
                @endforelse
            </div>
        </div>

        <!-- Category: Return & Refund Questions -->
        <div class="bg-white rounded-xl shadow-sm">
            <div class="bg-primary/10 px-6 py-4">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <i class="ri-arrow-go-back-line mr-3 text-primary text-2xl"></i>
                    İade ve Geri Ödeme
                </h2>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($returnFaqs as $index => $faq)
                    <div class="faq-item" x-data="{ open: false }">
                        <button 
                            class="w-full py-5 px-6 flex justify-between items-center text-left hover:bg-gray-50 transition-colors focus:outline-none group"
                            @click="open = !open"
                        >
                            <span class="font-medium text-gray-900 text-base md:text-lg group-hover:text-primary transition-colors">{{ $faq->question }}</span>
                            <span class="ml-4 flex-shrink-0 flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 group-hover:bg-primary/10 transition-colors">
                                <i class="ri-arrow-down-s-line text-lg text-gray-500 group-hover:text-primary transition-transform duration-300" :class="{'rotate-180': open}"></i>
                            </span>
                        </button>
                        <div 
                            class="overflow-hidden transition-all duration-300 max-h-0 bg-gray-50/50"
                            x-ref="content"
                            :style="open ? 'max-height: ' + $refs.content.scrollHeight + 'px' : 'max-height: 0px'"
                        >
                            <div class="p-6 prose prose-sm max-w-none">
                                {!! $faq->answer !!}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-4 text-gray-500 italic">Bu kategoride henüz soru bulunmamaktadır.</div>
                @endforelse
            </div>
        </div>

        <!-- Category: Account Questions -->
        <div class="bg-white rounded-xl shadow-sm">
            <div class="bg-primary/10 px-6 py-4">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <i class="ri-user-settings-line mr-3 text-primary text-2xl"></i>
                    Hesap
                </h2>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($accountFaqs as $index => $faq)
                    <div class="faq-item" x-data="{ open: false }">
                        <button 
                            class="w-full py-5 px-6 flex justify-between items-center text-left hover:bg-gray-50 transition-colors focus:outline-none group"
                            @click="open = !open"
                        >
                            <span class="font-medium text-gray-900 text-base md:text-lg group-hover:text-primary transition-colors">{{ $faq->question }}</span>
                            <span class="ml-4 flex-shrink-0 flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 group-hover:bg-primary/10 transition-colors">
                                <i class="ri-arrow-down-s-line text-lg text-gray-500 group-hover:text-primary transition-transform duration-300" :class="{'rotate-180': open}"></i>
                            </span>
                        </button>
                        <div 
                            class="overflow-hidden transition-all duration-300 max-h-0 bg-gray-50/50"
                            x-ref="content"
                            :style="open ? 'max-height: ' + $refs.content.scrollHeight + 'px' : 'max-height: 0px'"
                        >
                            <div class="p-6 prose prose-sm max-w-none">
                                {!! $faq->answer !!}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-4 text-gray-500 italic">Bu kategoride henüz soru bulunmamaktadır.</div>
                @endforelse
            </div>
        </div>

        <!-- Category: Payment Questions -->
        <div class="bg-white rounded-xl shadow-sm">
            <div class="bg-primary/10 px-6 py-4">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <i class="ri-secure-payment-line mr-3 text-primary text-2xl"></i>
                    Ödeme
                </h2>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($paymentFaqs as $index => $faq)
                    <div class="faq-item" x-data="{ open: false }">
                        <button 
                            class="w-full py-5 px-6 flex justify-between items-center text-left hover:bg-gray-50 transition-colors focus:outline-none group"
                            @click="open = !open"
                        >
                            <span class="font-medium text-gray-900 text-base md:text-lg group-hover:text-primary transition-colors">{{ $faq->question }}</span>
                            <span class="ml-4 flex-shrink-0 flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 group-hover:bg-primary/10 transition-colors">
                                <i class="ri-arrow-down-s-line text-lg text-gray-500 group-hover:text-primary transition-transform duration-300" :class="{'rotate-180': open}"></i>
                            </span>
                        </button>
                        <div 
                            class="overflow-hidden transition-all duration-300 max-h-0 bg-gray-50/50"
                            x-ref="content"
                            :style="open ? 'max-height: ' + $refs.content.scrollHeight + 'px' : 'max-height: 0px'"
                        >
                            <div class="p-6 prose prose-sm max-w-none">
                                {!! $faq->answer !!}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-4 text-gray-500 italic">Bu kategoride henüz soru bulunmamaktadır.</div>
                @endforelse
            </div>
        </div>
    </div>
    
    <!-- Contact CTA -->
    <div class="bg-primary/5 rounded-xl p-8 md:p-10 text-center shadow-sm">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-primary/10 rounded-full mb-6">
            <i class="ri-customer-service-2-line text-3xl text-primary"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-3">Sorunuzu bulamadınız mı?</h3>
        <p class="mb-6 text-gray-600 max-w-lg mx-auto">İhtiyaç duyduğunuz cevabı bulamadıysanız, müşteri destek ekibimiz size yardımcı olmaktan memnuniyet duyacaktır.</p>
        <a href="{{ route('pages.show', 'iletisim') }}" class="inline-flex items-center justify-center bg-primary hover:bg-primary-dark text-white px-6 py-3 rounded-md transition-colors">
            <i class="ri-mail-send-line mr-2"></i>
            İletişime Geçin
        </a>
    </div>
</div>

@push('scripts')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<style>
    .prose p {
        margin-top: 0.5em;
        margin-bottom: 0.5em;
    }
</style>
@endpush
@endsection 
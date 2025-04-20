@extends('front.layouts.app')

@section('title', 'Sık Sorulan Sorular')
@section('meta_description', 'Question Commerce SSS. Sık sorulan sorular ve yanıtları.')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Sık Sorulan Sorular</h1>
            
            <div class="accordion" id="faqAccordion">
                @forelse($faqs as $index => $faq)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $faq->id }}">
                            <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $faq->id }}">
                                {{ $faq->question }}
                            </button>
                        </h2>
                        <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                {!! $faq->answer !!}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">
                        Henüz sık sorulan soru bulunmamaktadır.
                    </div>
                @endforelse
            </div>
            
            <div class="mt-5">
                <h3>Sorunuzu bulamadınız mı?</h3>
                <p class="mb-4">İhtiyaç duyduğunuz cevabı bulamadıysanız, lütfen bizimle iletişime geçin.</p>
                <a href="{{ route('pages.show', 'iletisim') }}" class="btn btn-primary">İletişime Geçin</a>
            </div>
        </div>
    </div>
</div>
@endsection 
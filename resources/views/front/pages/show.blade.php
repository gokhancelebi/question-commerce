@extends('front.layouts.app')

@section('title', $page->meta_title ?? $page->title)
@section('meta_description', $page->meta_description)

@section('content')
<main>
    <section class="pt-32 pb-16 px-4">
        <div class="container mx-auto max-w-5xl">
            <div class="bg-white rounded-lg shadow-sm p-8">
                <h1 class="text-4xl font-bold mb-6 text-gray-900">{{ $page->title }}</h1>
                <div class="prose max-w-none">
                    {!! $page->content !!}
                </div>

                @if($page->slug === 'iletisim')
                <div class="mt-12 border-t pt-8">
                    <h2 class="text-2xl font-bold mb-6">Bize Ulaşın</h2>
                    <form id="contactForm" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Adınız</label>
                                <input type="text" id="name" name="name" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-primary focus:border-primary">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-posta Adresiniz</label>
                                <input type="email" id="email" name="email" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-primary focus:border-primary">
                            </div>
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Konu</label>
                            <input type="text" id="subject" name="subject" required
                                class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-primary focus:border-primary">
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Mesajınız</label>
                            <textarea id="message" name="message" rows="5" required
                                class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-primary focus:border-primary"></textarea>
                        </div>
                        <div>
                            <button type="submit"
                                class="bg-primary text-white px-6 py-3 !rounded-button hover:bg-opacity-90 transition-all">
                                Gönder
                            </button>
                        </div>
                    </form>
                </div>

                @push('scripts')
                <script>
                    document.getElementById('contactForm').addEventListener('submit', function(e) {
                        e.preventDefault();

                        const formData = new FormData(this);

                        fetch('{{ route("contact.store") }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(Object.fromEntries(formData))
                        })
                        .then(response => response.json())
                        .then(data => {
                            showNotification(data.message, 'success');
                            this.reset();
                        })
                        .catch(error => {
                            showNotification('Bir hata oluştu. Lütfen tekrar deneyin.', 'error');
                        });
                    });
                </script>
                @endpush
                @endif
            </div>
        </div>
    </section>
</main>
@endsection

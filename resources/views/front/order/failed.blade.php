@extends('front.layouts.app')

@section('content')
<div class="pt-24 pb-16">
    <div class="container mx-auto max-w-3xl px-4">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-6 text-center bg-red-50 border-b border-red-100">
                <div class="inline-flex h-20 w-20 mx-auto rounded-full bg-red-100 items-center justify-center">
                    <i class="ri-error-warning-line text-4xl text-red-500"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-800 mt-4">Sipariş Oluşturulamadı</h1>
                <p class="text-gray-600 mt-2">Siparişiniz işlenirken bir sorun oluştu.</p>
            </div>
            
            <div class="p-6">
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-3">Hata Detayları</h2>
                    <div class="bg-gray-50 p-4 rounded-md text-gray-700">
                        @if(session('error'))
                            <p>{{ session('error') }}</p>
                        @else
                            <p>İşlem sırasında beklenmeyen bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.</p>
                        @endif
                    </div>
                </div>
                
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-3">Şimdi Ne Yapmalıyım?</h2>
                    <ul class="list-disc list-inside space-y-2 text-gray-700">
                        <li>Sepetinizde hala ürünleriniz var, tekrar ödeme yapabilirsiniz.</li>
                        <li>Sorun devam ederse farklı bir ödeme yöntemi deneyebilirsiniz.</li>
                        <li>Teknik bir sorun yaşıyorsanız, destek ekibimizle iletişime geçebilirsiniz.</li>
                    </ul>
                </div>
            </div>
            
            <div class="p-6 bg-gray-50 border-t">
                <div class="flex flex-wrap gap-3 justify-center">
                    <a href="{{ route('cart.index') }}" class="w-full md:w-auto inline-flex items-center justify-center px-6 py-3 bg-primary text-white rounded-button hover:bg-opacity-90 transition-all">
                        <i class="ri-shopping-cart-line mr-2"></i> Sepete Dön
                    </a>
                    <a href="{{ route('checkout.index') }}" class="w-full md:w-auto inline-flex items-center justify-center px-6 py-3 bg-white text-primary border border-primary rounded-button hover:bg-gray-50 transition-all">
                        <i class="ri-arrow-right-line mr-2"></i> Tekrar Dene
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
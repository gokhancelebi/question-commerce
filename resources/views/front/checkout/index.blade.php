@extends('front.layouts.app')

@section('content')
<div class="pt-24 pb-16">
    <div class="container mx-auto max-w-6xl px-4">
        <h1 class="text-3xl font-semibold mb-8">Sipariş Bilgileri</h1>
        
        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Shipping Information -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="p-4 border-b">
                            <h2 class="text-xl font-medium">Teslimat Bilgileri</h2>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="shipping_name" class="text-sm font-medium text-gray-700">Ad</label>
                                    <input type="text" name="shipping_name" id="shipping_name" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-primary"
                                        value="{{ old('shipping_name', auth()->user()->name ?? '') }}" required>
                                    @error('shipping_name')
                                        <p class="text-red-500 text-xs">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="space-y-2">
                                    <label for="shipping_surname" class="text-sm font-medium text-gray-700">Soyad</label>
                                    <input type="text" name="shipping_surname" id="shipping_surname" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-primary"
                                        value="{{ old('shipping_surname') }}" required>
                                    @error('shipping_surname')
                                        <p class="text-red-500 text-xs">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="space-y-2">
                                <label for="shipping_email" class="text-sm font-medium text-gray-700">E-posta</label>
                                <input type="email" name="shipping_email" id="shipping_email" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-primary"
                                    value="{{ old('shipping_email', auth()->user()->email ?? '') }}" required>
                                @error('shipping_email')
                                    <p class="text-red-500 text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="space-y-2">
                                <label for="shipping_phone" class="text-sm font-medium text-gray-700">Telefon</label>
                                <input type="text" name="shipping_phone" id="shipping_phone" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-primary"
                                    value="{{ old('shipping_phone') }}" required>
                                @error('shipping_phone')
                                    <p class="text-red-500 text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="city" class="text-sm font-medium text-gray-700">İl</label>
                                    <input type="text" name="city" id="city" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-primary"
                                        value="{{ old('city') }}" required>
                                    @error('city')
                                        <p class="text-red-500 text-xs">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="space-y-2">
                                    <label for="district" class="text-sm font-medium text-gray-700">İlçe</label>
                                    <input type="text" name="district" id="district" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-primary"
                                        value="{{ old('district') }}" required>
                                    @error('district')
                                        <p class="text-red-500 text-xs">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="space-y-2">
                                <label for="address" class="text-sm font-medium text-gray-700">Adres</label>
                                <textarea name="address" id="address" rows="3" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-primary"
                                    required>{{ old('address') }}</textarea>
                                @error('address')
                                    <p class="text-red-500 text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="p-4 border-b">
                            <h2 class="text-xl font-medium">Sipariş Özeti</h2>
                        </div>
                        <div class="p-4 divide-y divide-gray-100">
                            @foreach($cartItems as $item)
                            <div class="flex items-start py-4 first:pt-0">
                                <div class="w-16 h-16 flex-shrink-0 bg-gray-100 rounded overflow-hidden mr-3">
                                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover object-center">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-medium text-sm truncate">{{ $item['name'] }}</h4>
                                    <p class="text-xs text-gray-500 mb-1">{{ $item['quantity'] }} adet</p>
                                    <span class="font-medium text-sm">{{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }} TL</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="p-4 bg-gray-50">
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Ara Toplam:</span>
                                <span class="font-medium">{{ number_format($subtotal, 2, ',', '.') }} TL</span>
                            </div>
                            <div class="flex justify-between mb-4">
                                <span class="text-gray-600">Kargo:</span>
                                <span class="font-medium">{{ number_format($shipping, 2, ',', '.') }} TL</span>
                            </div>
                            <div class="flex justify-between mb-6 text-lg font-bold">
                                <span>Toplam:</span>
                                <span class="text-primary">{{ number_format($total, 2, ',', '.') }} TL</span>
                            </div>
                            <button type="submit" class="w-full bg-primary text-white py-3 !rounded-button hover:bg-opacity-90 transition-all flex items-center justify-center">
                                <div class="w-5 h-5 mr-2 flex items-center justify-center">
                                    <i class="ri-secure-payment-line"></i>
                                </div>
                                Siparişi Tamamla
                            </button>
                            <div class="mt-4 text-center text-sm text-gray-500">
                                <p>Siparişinizi tamamladığınızda, ödeme onayı otomatik olarak yapılacaktır.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection 
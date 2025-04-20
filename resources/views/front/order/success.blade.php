@extends('front.layouts.app')

@section('content')
<div class="pt-24 pb-16">
    <div class="container mx-auto max-w-3xl px-4">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-6 text-center bg-green-50 border-b border-green-100">
                <div class="inline-flex h-20 w-20 mx-auto rounded-full bg-green-100 items-center justify-center">
                    <i class="ri-check-line text-4xl text-green-500"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-800 mt-4">Sipariş Başarıyla Oluşturuldu!</h1>
                <p class="text-gray-600 mt-2">Siparişiniz için teşekkür ederiz.</p>
            </div>
            
            <div class="p-6">
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-3">Sipariş Detayları</h2>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="text-sm text-gray-500">Sipariş Durumu</p>
                            <div class="mt-1 font-medium">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs bg-green-100 text-green-800">
                                    {{ $order->status_label }}
                                </span>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Sipariş Tarihi</p>
                            <p class="mt-1 font-medium">{{ $order->created_at->format('d.m.Y H:i') }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-3">Teslimat Bilgileri</h2>
                    <div class="bg-gray-50 p-4 rounded-md">
                        <p class="font-medium">{{ $order->shipping_name }} {{ $order->shipping_surname }}</p>
                        <p class="text-gray-700 mt-1">{{ $order->address }}</p>
                        <p class="text-gray-700">{{ $order->district }}, {{ $order->city }}</p>
                        <p class="text-gray-700 mt-2">{{ $order->shipping_phone }}</p>
                        <p class="text-gray-700">{{ $order->shipping_email }}</p>
                    </div>
                </div>
                
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-3">Ürünler</h2>
                    <div class="divide-y divide-gray-200">
                        @foreach($order->items as $item)
                        <div class="py-3 flex">
                            @if($item->product && $item->product->image)
                            <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="h-full w-full object-cover object-center">
                            </div>
                            @else
                            <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-md border border-gray-200 bg-gray-100">
                            </div>
                            @endif
                            <div class="ml-4 flex flex-1 flex-col">
                                <div>
                                    <div class="flex justify-between text-base font-medium text-gray-900">
                                        <h3>
                                            {{ $item->product ? $item->product->name : 'Ürün bulunamadı' }}
                                        </h3>
                                        <p class="ml-4">{{ number_format($item->price, 2, ',', '.') }} TL</p>
                                    </div>
                                </div>
                                <div class="flex flex-1 items-end justify-between text-sm">
                                    <p class="text-gray-500">Adet: {{ $item->quantity }}</p>
                                    <p class="text-gray-700 font-medium">{{ number_format($item->price * $item->quantity, 2, ',', '.') }} TL</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="border-t border-gray-200 pt-4">
                    <div class="flex justify-between text-base mb-2">
                        <p class="text-gray-600">Toplam Tutar</p>
                        <p class="font-medium text-lg text-primary">{{ number_format($order->total_amount, 2, ',', '.') }} TL</p>
                    </div>
                </div>
            </div>
            
            <div class="p-6 bg-gray-50 border-t">
                <div class="flex flex-wrap gap-3 justify-center">
                    <a href="{{ route('home') }}" class="w-full md:w-auto inline-flex items-center justify-center px-6 py-3 bg-primary text-white rounded-button hover:bg-opacity-90 transition-all">
                        <i class="ri-home-line mr-2"></i> Ana Sayfaya Dön
                    </a>
                    @auth
                    <a href="{{ route('user.orders') }}" class="w-full md:w-auto inline-flex items-center justify-center px-6 py-3 bg-white text-primary border border-primary rounded-button hover:bg-gray-50 transition-all">
                        <i class="ri-file-list-line mr-2"></i> Siparişlerim
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
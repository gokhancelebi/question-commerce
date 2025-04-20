@extends('front.layouts.account')

@section('account_title', 'Sipariş Detayı')
@section('account_subtitle', 'Sipariş #' . $order->id . ' detayları')

@section('account_content')
<div class="bg-white rounded-lg shadow overflow-hidden mb-6">
    <div class="p-4 border-b">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-medium">Sipariş Detayları</h2>
            <a href="{{ route('user.orders') }}" class="inline-flex items-center text-sm text-primary hover:text-primary-dark">
                <i class="ri-arrow-left-line mr-1"></i> Siparişlerime Dön
            </a>
        </div>
    </div>
    <div class="p-4">
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <p class="text-sm text-gray-500">Sipariş No</p>
                <p class="mt-1 font-medium">#{{ $order->id }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Sipariş Tarihi</p>
                <p class="mt-1 font-medium">{{ $order->created_at->format('d.m.Y H:i') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Sipariş Durumu</p>
                <div class="mt-1">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs 
                        @if($order->status == 'completed')
                            bg-green-100 text-green-800
                        @elseif($order->status == 'processing')
                            bg-blue-100 text-blue-800
                        @elseif($order->status == 'cancelled')
                            bg-red-100 text-red-800
                        @else
                            bg-yellow-100 text-yellow-800
                        @endif
                    ">
                        {{ $order->status_label }}
                    </span>
                </div>
            </div>
            <div>
                <p class="text-sm text-gray-500">Toplam Tutar</p>
                <p class="mt-1 font-medium">{{ number_format($order->total_amount, 2, ',', '.') }} TL</p>
            </div>
        </div>
    </div>
</div>

<!-- Order Items -->
<div class="bg-white rounded-lg shadow overflow-hidden mb-6">
    <div class="p-4 border-b">
        <h2 class="text-xl font-medium">Sipariş Edilen Ürünler</h2>
    </div>
    <div class="divide-y divide-gray-200">
        @foreach($order->items as $item)
        <div class="p-4 flex">
            <div class="flex-shrink-0 w-16 h-16 bg-gray-100 rounded-md overflow-hidden mr-4">
                @if($item->product && $item->product->featured_image)
                    <img src="{{ asset($item->product->featured_image) }}" alt="{{ $item->product->title }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                        <i class="ri-image-line text-2xl"></i>
                    </div>
                @endif
            </div>
            <div class="flex-1">
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="text-base font-medium text-gray-900">
                            @if($item->product)
                                {{ $item->product->title }}
                            @else
                                Ürün artık mevcut değil
                            @endif
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">Adet: {{ $item->quantity }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-900">{{ number_format($item->price, 2, ',', '.') }} TL</p>
                        <p class="mt-1 text-sm text-gray-700">Toplam: {{ number_format($item->price * $item->quantity, 2, ',', '.') }} TL</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="p-4 bg-gray-50 border-t">
        <div class="flex justify-between items-center">
            <span class="font-medium">Toplam</span>
            <span class="font-bold text-lg text-primary">{{ number_format($order->total_amount, 2, ',', '.') }} TL</span>
        </div>
    </div>
</div>

<!-- Shipping Information -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-4 border-b">
        <h2 class="text-xl font-medium">Teslimat Bilgileri</h2>
    </div>
    <div class="p-4">
        <div class="mb-4">
            <h3 class="text-sm font-semibold text-gray-700 mb-1">Teslimat Adresi</h3>
            <p class="text-gray-700">{{ $order->shipping_name }} {{ $order->shipping_surname }}</p>
            <p class="text-gray-700">{{ $order->address }}</p>
            <p class="text-gray-700">{{ $order->district }}, {{ $order->city }}</p>
        </div>
        <div>
            <h3 class="text-sm font-semibold text-gray-700 mb-1">İletişim Bilgileri</h3>
            <p class="text-gray-700">{{ $order->shipping_email }}</p>
            <p class="text-gray-700">{{ $order->shipping_phone }}</p>
        </div>
    </div>
</div>
@endsection 
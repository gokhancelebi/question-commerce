@extends('front.layouts.app')

@section('content')
<div class="pt-24 pb-16">
    <div class="container mx-auto max-w-6xl px-4">
        <div class="mb-8">
            <h1 class="text-3xl font-semibold mb-2">Siparişlerim</h1>
            <p class="text-gray-600">Sipariş geçmişinizi görüntüleyin</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Sidebar -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-4 border-b">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-white">
                                <i class="ri-user-line ri-lg"></i>
                            </div>
                            <div class="ml-3">
                                <p class="font-medium">{{ $user->name }} {{ $user->surname }}</p>
                                <p class="text-sm text-gray-500">{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="py-2">
                        <a href="{{ route('user.account') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50">
                            <i class="ri-user-settings-line mr-3"></i>
                            <span>Hesap Bilgileri</span>
                        </a>
                        <a href="{{ route('user.orders') }}" class="flex items-center px-4 py-3 text-primary bg-gray-50">
                            <i class="ri-history-line mr-3"></i>
                            <span>Siparişlerim</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="border-t">
                            @csrf
                            <button type="submit" class="w-full flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50">
                                <i class="ri-logout-box-line mr-3"></i>
                                <span>Çıkış Yap</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="md:col-span-3">
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    @if(count($orders) > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sipariş No</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tarih</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tutar</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durum</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">İşlem</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($orders as $order)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $order->id ?? '123456' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->created_at ?? '01.07.2023' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->total ?? '1.299,99 TL' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ $order->status ?? 'Tamamlandı' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <a href="#" class="text-primary hover:underline">Detaylar</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-8 text-center">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="ri-shopping-bag-line text-gray-400 text-xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Henüz siparişiniz bulunmuyor</h3>
                            <p class="text-gray-500 mb-6">Alışverişe başlayarak ilk siparişinizi oluşturun</p>
                            <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-opacity-90">
                                <i class="ri-shopping-cart-line mr-2"></i>
                                Alışverişe Başla
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
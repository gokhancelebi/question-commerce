@extends('front.layouts.account')

@section('account_title', 'Siparişlerim')
@section('account_subtitle', 'Tüm siparişlerinizi görüntüleyin ve takip edin')

@section('account_content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    @if($orders->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sipariş No</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tarih</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durum</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Toplam</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">İşlemler</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($orders as $order)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                #{{ $order->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $order->created_at->format('d.m.Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
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
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ number_format($order->total_amount, 2, ',', '.') }} TL
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('user.orders.show', $order->id) }}" class="text-primary hover:text-primary-dark">
                                    Detaylar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $orders->links() }}
        </div>
    @else
        <div class="p-8 text-center">
            <div class="inline-flex h-16 w-16 mx-auto rounded-full bg-gray-100 items-center justify-center mb-4">
                <i class="ri-shopping-basket-line text-2xl text-gray-500"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Henüz sipariş vermediniz</h3>
            <p class="text-gray-500 mb-6">Siparişleriniz burada görüntülenecektir.</p>
            <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-button shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-dark">
                Alışverişe Başla
            </a>
        </div>
    @endif
</div>
@endsection 
@extends('admin.layouts.app')

@section('title', 'Sipariş Detayı')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Sipariş #{{ $order->id }}</h1>
        <div>
            <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-primary me-2">
                <i class="fas fa-edit"></i> Düzenle
            </a>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Listeye Dön
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Sipariş Detayları</h3>
                </div>
                <div class="card-body p-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Ürün</th>
                                <th>Fiyat</th>
                                <th>Adet</th>
                                <th>Toplam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->product->title }}</td>
                                    <td>{{ number_format($item->price, 2) }} TL</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->total, 2) }} TL</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Ürünler Toplamı:</strong></td>
                                <td><strong>{{ number_format($order->items_total, 2) }} TL</strong></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Kargo Ücreti:</strong></td>
                                <td><strong>{{ number_format($order->shipping_cost ?? 0, 2) }} TL</strong></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Genel Toplam:</strong></td>
                                <td><strong>{{ number_format($order->total_amount, 2) }} TL</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Müşteri Bilgileri</h3>
                </div>
                <div class="card-body p-4">
                    <p><strong>Ad Soyad:</strong> {{ $order->user->full_name }}</p>
                    <p><strong>E-posta:</strong> {{ $order->user->email }}</p>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Teslimat Bilgileri</h3>
                </div>
                <div class="card-body p-4">
                    <p><strong>Ad Soyad:</strong> {{ $order->shipping_name }} {{ $order->shipping_surname }}</p>
                    <p><strong>Telefon:</strong> {{ $order->shipping_phone }}</p>
                    <p><strong>Şehir:</strong> {{ $order->city }}</p>
                    <p><strong>İlçe:</strong> {{ $order->district }}</p>
                    <p><strong>Adres:</strong> {{ $order->address }}</p>
                    @if($order->shipping_code || $order->shipping_company)
                    <hr class="my-3">
                    <h4 class="text-lg font-semibold mb-2">Kargo Bilgileri</h4>
                    @if($order->shipping_company)
                    <p><strong>Kargo Firması:</strong> {{ $order->shipping_company }}</p>
                    @endif
                    @if($order->shipping_code)
                    <p><strong>Kargo Kodu:</strong> {{ $order->shipping_code }}</p>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
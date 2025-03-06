@extends('admin.layouts.app')

@section('title', 'Sipariş Detayı')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Sipariş #{{ $order->id }}</h1>
            </div>
            <div class="col-sm-6">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary float-right">
                    <i class="fas fa-arrow-left"></i> Geri
                </a>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Sipariş Bilgileri</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 200px">Sipariş No</th>
                                <td>#{{ $order->id }}</td>
                            </tr>
                            <tr>
                                <th>Müşteri</th>
                                <td>{{ $order->user->name }}</td>
                            </tr>
                            <tr>
                                <th>E-posta</th>
                                <td>{{ $order->user->email }}</td>
                            </tr>
                            <tr>
                                <th>Toplam Tutar</th>
                                <td>{{ number_format($order->total_amount, 2) }} ₺</td>
                            </tr>
                            <tr>
                                <th>Durum</th>
                                <td>
                                    <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="d-flex align-items-center">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="form-control mr-2" style="width: 150px">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Bekliyor</option>
                                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>İşleniyor</option>
                                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Tamamlandı</option>
                                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>İptal Edildi</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary">Güncelle</button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <th>Tarih</th>
                                <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Teslimat Bilgileri</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 200px">Ad</th>
                                <td>{{ $order->shipping_name }}</td>
                            </tr>
                            <tr>
                                <th>Soyad</th>
                                <td>{{ $order->shipping_surname }}</td>
                            </tr>
                            <tr>
                                <th>Telefon</th>
                                <td>{{ $order->shipping_phone }}</td>
                            </tr>
                            <tr>
                                <th>E-posta</th>
                                <td>{{ $order->shipping_email }}</td>
                            </tr>
                            <tr>
                                <th>Şehir</th>
                                <td>{{ $order->city }}</td>
                            </tr>
                            <tr>
                                <th>İlçe</th>
                                <td>{{ $order->district }}</td>
                            </tr>
                            <tr>
                                <th>Adres</th>
                                <td>{{ $order->address }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Sipariş Ürünleri</h3>
            </div>
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Ürün</th>
                            <th>Birim Fiyat</th>
                            <th>Adet</th>
                            <th>Toplam</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>{{ $item->product->title }}</td>
                                <td>{{ number_format($item->price, 2) }} ₺</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->price * $item->quantity, 2) }} ₺</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-right">Toplam:</th>
                            <th>{{ number_format($order->total_amount, 2) }} ₺</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 
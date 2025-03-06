@extends('admin.layouts.app')

@section('title', 'İletişim Mesajı')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">İletişim Mesajı</h1>
            </div>
            <div class="col-sm-6">
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary float-right">
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
                        <h3 class="card-title">Mesaj Detayları</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 200px">Tarih</th>
                                <td>{{ $contact->created_at->format('d.m.Y H:i') }}</td>
                            </tr>
                            @if($contact->user_id)
                                <tr>
                                    <th>Üyelik Durumu</th>
                                    <td>
                                        <span class="badge badge-success">Kayıtlı Üye</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Üye Bilgileri</th>
                                    <td>
                                        <strong>Ad Soyad:</strong> {{ $contact->user->getFullNameAttribute() }}<br>
                                        <strong>E-posta:</strong> {{ $contact->user->email }}<br>
                                        @if($contact->user->hasDefaultShippingInfo())
                                            <strong>Telefon:</strong> {{ $contact->user->default_shipping_phone }}<br>
                                            <strong>Adres:</strong> {{ $contact->user->default_address }}<br>
                                            <strong>İlçe/İl:</strong> {{ $contact->user->default_district }}/{{ $contact->user->default_city }}
                                        @endif
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <th>Ad Soyad</th>
                                    <td>{{ $contact->name }} {{ $contact->surname }}</td>
                                </tr>
                                <tr>
                                    <th>E-posta</th>
                                    <td>{{ $contact->email }}</td>
                                </tr>
                            @endif
                            <tr>
                                <th>Konu</th>
                                <td>{{ $contact->subject }}</td>
                            </tr>
                            <tr>
                                <th>Durum</th>
                                <td>{!! $contact->status_badge !!}</td>
                            </tr>
                            <tr>
                                <th>Mesaj</th>
                                <td>{{ $contact->message }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Yanıt</h3>
                        @if($contact->status === 'replied')
                            <span class="badge badge-success float-right">Yanıtlandı</span>
                        @endif
                    </div>
                    @if($contact->reply)
                        <div class="card-body">
                            <div class="alert alert-info">
                                <strong>Yanıt Tarihi:</strong> {{ $contact->replied_at->format('d.m.Y H:i') }}
                            </div>
                            <div class="form-group">
                                <label>Yanıt Metni</label>
                                <div class="p-3 bg-light rounded">{{ $contact->reply }}</div>
                            </div>
                        </div>
                    @else
                        <form action="{{ route('admin.contacts.update', $contact) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="reply">Yanıt Metni</label>
                                    <textarea name="reply" id="reply" rows="5" class="form-control @error('reply') is-invalid @enderror">{{ old('reply') }}</textarea>
                                    @error('reply')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane"></i> Yanıtla
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

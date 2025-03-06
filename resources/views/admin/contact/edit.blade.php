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
                            <tr>
                                <th>Ad Soyad</th>
                                <td>{{ $contact->name }}</td>
                            </tr>
                            <tr>
                                <th>E-posta</th>
                                <td>{{ $contact->email }}</td>
                            </tr>
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
                    </div>
                    <form action="{{ route('admin.contacts.update', $contact) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            @if($contact->reply)
                                <div class="alert alert-info">
                                    <strong>Yanıt Tarihi:</strong> {{ $contact->replied_at->format('d.m.Y H:i') }}
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="reply">Yanıt Metni</label>
                                <textarea name="reply" id="reply" rows="5" class="form-control @error('reply') is-invalid @enderror">{{ old('reply', $contact->reply) }}</textarea>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('admin.layouts.app')

@section('title', 'İletişim Mesajı')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>İletişim Mesajı</h1>
        <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Listeye Dön
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Ad Soyad:</strong> {{ $contact->name }}</p>
                    <p><strong>Email:</strong> {{ $contact->email }}</p>
                    <p><strong>Telefon:</strong> {{ $contact->phone }}</p>
                    <p><strong>Tarih:</strong> {{ $contact->created_at->format('d.m.Y H:i') }}</p>
                </div>
            </div>

            <div class="mt-4">
                <h5>Konu</h5>
                <p>{{ $contact->subject }}</p>
            </div>

            <div class="mt-4">
                <h5>Mesaj</h5>
                <p>{{ $contact->message }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

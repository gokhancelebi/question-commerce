@extends('admin.layouts.app')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ $user->exists ? 'Kullanıcı Düzenle' : 'Yeni Kullanıcı' }}</h1>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Listeye Dön
        </a>
    </div>

    <div class="card">
        <div class="card-body p-4">
            <form action="{{ $user->exists ? route('admin.users.update', $user->id) : route('admin.users.store') }}" method="POST">
                @csrf
                @if($user->exists)
                    @method('PUT')
                @endif

                @include('admin.user._form')

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> {{ $user->exists ? 'Güncelle' : 'Oluştur' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('admin.layouts.app')

@section('title', 'Yeni Soru Ekle')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Yeni Soru Ekle</h1>
        <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Geri
        </a>
    </div>

    <div class="card">
        <form action="{{ route('admin.faqs.store') }}" method="POST">
            @csrf
            <div class="card-body">
                @include('admin.faqs._form')
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Kaydet</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Add editor for content if needed
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof ClassicEditor !== 'undefined') {
            ClassicEditor
                .create(document.querySelector('#answer'))
                .catch(error => {
                    console.error(error);
                });
        }
    });
</script>
@endpush 
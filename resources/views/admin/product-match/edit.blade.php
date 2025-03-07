@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ $productMatch->exists ? 'Eşleştirme Düzenle' : 'Yeni Eşleştirme' }}</h1>
        <a href="{{ route('admin.product-matches.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Listeye Dön
        </a>
    </div>

    <form action="{{ $productMatch->exists ? route('admin.product-matches.update', $productMatch->id) : route('admin.product-matches.store') }}" method="POST">
        @csrf
        @if($productMatch->exists)
            @method('PUT')
        @endif

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="product_id" class="form-label">Ürün</label>
                        <select class="form-select @error('product_id') is-invalid @enderror" id="product_id" name="product_id" required>
                            <option value="">Ürün Seçin</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ old('product_id', $productMatch->product_id) == $product->id ? 'selected' : '' }}>
                                    {{ $product->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label d-block">Durum</label>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input @error('is_active') is-invalid @enderror" id="is_active" name="is_active" value="1" {{ old('is_active', $productMatch->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Aktif</label>
                        </div>
                        @error('is_active')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <h4 class="mt-4 mb-3">Cevap Kombinasyonu</h4>
                @foreach($questions as $question)
                    <div class="mb-4">
                        <label class="form-label">{{ $question->title }}</label>
                        <div class="list-group">
                            @foreach($question->answers as $answer)
                                <label class="list-group-item">
                                    <input type="radio" 
                                           name="answer_combinations[]" 
                                           value="{{ $answer->id }}"
                                           class="form-check-input me-2"
                                           {{ in_array($answer->id, old('answer_combinations', $productMatch->answer_combinations ?? [])) ? 'checked' : '' }}
                                           required>
                                    {{ $answer->content }}
                                </label>
                            @endforeach
                        </div>
                        @error('answer_combinations.'.$loop->index)
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> {{ $productMatch->exists ? 'Güncelle' : 'Oluştur' }}
            </button>
        </div>
    </form>
</div>
@endsection 
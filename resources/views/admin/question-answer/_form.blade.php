@csrf

<div class="card mb-4">
    <div class="card-body">
        <h4 class="card-title mb-4">Soru Bilgileri</h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="title" class="form-label">Soru Başlığı</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $question->title) }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-2 mb-3">
                <label for="order" class="form-label">Sıra</label>
                <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', $question->order) }}">
                @error('order')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label d-block">Durum</label>
                <div class="form-check form-check-inline">
                    <input type="checkbox" class="form-check-input @error('is_active') is-invalid @enderror" id="is_active" name="is_active" value="1" {{ old('is_active', $question->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Aktif</label>
                </div>
                @error('is_active')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 mb-3">
                <label for="description" class="form-label">Açıklama</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $question->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="card-title mb-0">Cevaplar</h4>
            <button type="button" class="btn btn-success" id="add-answer-btn">
                <i class="fas fa-plus"></i> Yeni Cevap Ekle
            </button>
        </div>

        <div id="answers-container">
            @foreach(old('answers', $question->answers ?? []) as $index => $answer)
                <div class="answer-item card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h5 class="card-title mb-0">Cevap {{ $index + 1 }}</h5>
                            <button type="button" class="btn btn-sm btn-danger remove-answer" title="Cevabı Sil">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Cevap İçeriği</label>
                            <textarea name="answers[{{ $index }}][content]" class="form-control @error('answers.'.$index.'.content') is-invalid @enderror" rows="2" required>{{ old('answers.'.$index.'.content', $answer['content'] ?? $answer->content ?? '') }}</textarea>
                            @error('answers.'.$index.'.content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sıra</label>
                            <input type="number" name="answers[{{ $index }}][order]" class="form-control @error('answers.'.$index.'.order') is-invalid @enderror" value="{{ old('answers.'.$index.'.order', $answer['order'] ?? $answer->order ?? $index) }}">
                            @error('answers.'.$index.'.order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @error('answers')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

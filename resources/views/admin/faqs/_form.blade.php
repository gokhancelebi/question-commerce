<div class="mb-3">
    <label for="question" class="form-label">Soru</label>
    <input type="text" class="form-control @error('question') is-invalid @enderror" id="question" name="question" value="{{ old('question', $faq->question ?? '') }}" required>
    @error('question')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="answer" class="form-label">Cevap</label>
    <textarea class="form-control @error('answer') is-invalid @enderror" id="answer" name="answer" rows="6" required>{{ old('answer', $faq->answer ?? '') }}</textarea>
    @error('answer')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="order" class="form-label">Sıralama</label>
            <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', $faq->order ?? 0) }}">
            @error('order')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <div class="form-check form-switch mt-4">
                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $faq->is_active ?? 1) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Aktif</label>
            </div>
        </div>
    </div>
</div>

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
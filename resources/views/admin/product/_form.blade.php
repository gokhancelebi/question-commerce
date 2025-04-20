<div class="row">
    <div class="col-md-8">
        <div class="mb-3">
            <label for="title" class="form-label">Ürün Adı</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $product->title) }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Açıklama</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="external_url" class="form-label">Harici Satın Alma URL'si</label>
            <input type="url" class="form-control @error('external_url') is-invalid @enderror" id="external_url" name="external_url" value="{{ old('external_url', $product->external_url) }}" placeholder="https://example.com/product">
            <small class="form-text text-muted">Ürün harici bir siteden satın alınacaksa URL'yi buraya girin. Boş bırakılırsa normal satın alma işlemi gerçekleşir.</small>
            @error('external_url')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="price" class="form-label">Fiyat</label>
                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $product->price) }}" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="quantity" class="form-label">Stok</label>
                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}" required>
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label for="featured_image" class="form-label">Kapak Resmi</label>
            <input type="file" class="form-control @error('featured_image') is-invalid @enderror" id="featured_image" name="featured_image" accept="image/*">
            @error('featured_image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            @if($product->featured_image)
                <div class="mt-2">
                    <img src="{{ asset($product->featured_image) }}" alt="Mevcut kapak resmi" class="img-thumbnail" style="max-height: 150px;">
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="gallery" class="form-label">Galeri Resimleri</label>
            <input type="file" class="form-control @error('gallery.*') is-invalid @enderror" id="gallery" name="gallery[]" accept="image/*" multiple>
            @error('gallery.*')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            @if($product->images->count() > 0)
                <div class="mt-3">
                    <label class="form-label">Mevcut Galeri Resimleri</label>
                    <div class="row g-2" id="galleryImagesContainer">
                        @foreach($product->images as $image)
                            <div class="col-6 position-relative gallery-image-container mb-3" id="image-container-{{ $image->id }}">
                                <div class="card h-100">
                                    <img src="{{ asset($image->image_path) }}" alt="Galeri resmi" class="card-img-top" style="height: 100px; object-fit: cover;">
                                    <div class="card-body p-2 d-flex justify-content-between align-items-center">
                                        <div class="form-check">
                                            <input class="form-check-input delete-image-checkbox" type="checkbox" name="delete_images[]" value="{{ $image->id }}" id="delete_image_{{ $image->id }}" onchange="toggleImageVisibility(this, {{ $image->id }})">
                                            <label class="form-check-label" for="delete_image_{{ $image->id }}">
                                                Sil
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-2">
                        <button type="button" id="selectAllImages" class="btn btn-sm btn-outline-danger">Tümünü Seç</button>
                        <button type="button" id="deselectAllImages" class="btn btn-sm btn-outline-secondary">Seçimi Kaldır</button>
                    </div>
                </div>
            @endif
        </div>

        <div class="mb-3">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Aktif</label>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Summernote editor for product description
        $('#description').summernote({
            height: 200,
            lang: 'tr-TR',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview']]
            ],
            placeholder: 'Ürün açıklamasını buraya girin...'
        });

        // Image gallery selection functionality
        const selectAllBtn = document.getElementById('selectAllImages');
        const deselectAllBtn = document.getElementById('deselectAllImages');

        if (selectAllBtn) {
            selectAllBtn.addEventListener('click', function() {
                document.querySelectorAll('.delete-image-checkbox').forEach(checkbox => {
                    checkbox.checked = true;
                    toggleImageVisibility(checkbox, checkbox.value);
                });
            });
        }

        if (deselectAllBtn) {
            deselectAllBtn.addEventListener('click', function() {
                document.querySelectorAll('.delete-image-checkbox').forEach(checkbox => {
                    checkbox.checked = false;
                    toggleImageVisibility(checkbox, checkbox.value);
                });
            });
        }
    });

    // Function to instantly toggle image visibility when checkbox is clicked
    function toggleImageVisibility(checkbox, imageId) {
        const container = document.getElementById('image-container-' + imageId);
        if (container) {
            if (checkbox.checked) {
                container.style.opacity = '0.5';
                container.querySelector('.card').style.borderColor = '#dc3545';
                container.querySelector('.card').style.borderWidth = '2px';
                container.querySelector('.form-check-label').textContent = 'Siliniyor';
            } else {
                container.style.opacity = '1';
                container.querySelector('.card').style.borderColor = '';
                container.querySelector('.card').style.borderWidth = '';
                container.querySelector('.form-check-label').textContent = 'Sil';
            }
        }
    }
</script>
@endpush

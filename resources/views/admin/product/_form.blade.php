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
                <div class="mt-2">
                    <div class="row g-2">
                        @foreach($product->images as $image)
                            <div class="col-6">
                                <img src="{{ asset($image->image_path) }}" alt="Galeri resmi" class="img-thumbnail w-100" style="height: 100px; object-fit: cover;">
                            </div>
                        @endforeach
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

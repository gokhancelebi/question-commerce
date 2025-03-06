<div class="form-group">
    <label for="title">Ürün Adı</label>
    <input type="text" 
           name="title" 
           id="title" 
           class="form-control @error('title') is-invalid @enderror" 
           value="{{ old('title', $product->title ?? '') }}" 
           required>
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="description">Açıklama</label>
    <textarea name="description" 
              id="description" 
              class="form-control @error('description') is-invalid @enderror" 
              rows="4">{{ old('description', $product->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="price">Fiyat</label>
            <input type="number" 
                   name="price" 
                   id="price" 
                   class="form-control @error('price') is-invalid @enderror" 
                   value="{{ old('price', $product->price ?? '') }}" 
                   step="0.01" 
                   min="0" 
                   required>
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="quantity">Stok</label>
            <input type="number" 
                   name="quantity" 
                   id="quantity" 
                   class="form-control @error('quantity') is-invalid @enderror" 
                   value="{{ old('quantity', $product->quantity ?? 0) }}" 
                   min="0" 
                   required>
            @error('quantity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="form-group">
    <label for="featured_image">Kapak Görseli</label>
    <input type="file" 
           name="featured_image" 
           id="featured_image" 
           class="form-control-file @error('featured_image') is-invalid @enderror"
           accept="image/*">
    @error('featured_image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @if(isset($product) && $product->featured_image)
        <div class="mt-2">
            <img src="{{ Storage::url($product->featured_image) }}" 
                 alt="Mevcut görsel" 
                 class="img-thumbnail" 
                 style="max-height: 100px">
        </div>
    @endif
</div>

<div class="form-group">
    <label for="gallery">Galeri Görselleri</label>
    <input type="file" 
           name="gallery[]" 
           id="gallery" 
           class="form-control-file @error('gallery.*') is-invalid @enderror"
           accept="image/*" 
           multiple>
    @error('gallery.*')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @if(isset($product) && $product->images->count() > 0)
        <div class="row mt-2">
            @foreach($product->images as $image)
                <div class="col-md-2">
                    <img src="{{ Storage::url($image->image_path) }}" 
                         alt="Galeri görseli" 
                         class="img-thumbnail" 
                         style="max-height: 100px">
                </div>
            @endforeach
        </div>
    @endif
</div>

<div class="form-group">
    <div class="custom-control custom-switch">
        <input type="checkbox" 
               name="is_active" 
               class="custom-control-input" 
               id="is_active" 
               value="1" 
               {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
        <label class="custom-control-label" for="is_active">Aktif</label>
    </div>
</div>

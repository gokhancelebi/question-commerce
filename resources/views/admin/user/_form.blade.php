@csrf

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Ad</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="surname" class="form-label">Soyad</label>
                <input type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" name="surname" value="{{ old('surname', $user->surname) }}" required>
                @error('surname')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="password" class="form-label">Şifre {{ $user->exists ? '(değiştirmek için doldurun)' : '' }}</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" {{ $user->exists ? '' : 'required' }}>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="role" class="form-label">Rol</label>
                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Kullanıcı</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Yönetici</option>
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <h4 class="mt-4">Varsayılan Teslimat Bilgileri</h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="default_shipping_name" class="form-label">Teslimat Adı</label>
                <input type="text" class="form-control @error('default_shipping_name') is-invalid @enderror" id="default_shipping_name" name="default_shipping_name" value="{{ old('default_shipping_name', $user->default_shipping_name) }}">
                @error('default_shipping_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="default_shipping_surname" class="form-label">Teslimat Soyadı</label>
                <input type="text" class="form-control @error('default_shipping_surname') is-invalid @enderror" id="default_shipping_surname" name="default_shipping_surname" value="{{ old('default_shipping_surname', $user->default_shipping_surname) }}">
                @error('default_shipping_surname')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="default_shipping_phone" class="form-label">Teslimat Telefonu</label>
                <input type="text" class="form-control @error('default_shipping_phone') is-invalid @enderror" id="default_shipping_phone" name="default_shipping_phone" value="{{ old('default_shipping_phone', $user->default_shipping_phone) }}">
                @error('default_shipping_phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="default_city" class="form-label">Şehir</label>
                <input type="text" class="form-control @error('default_city') is-invalid @enderror" id="default_city" name="default_city" value="{{ old('default_city', $user->default_city) }}">
                @error('default_city')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="default_district" class="form-label">İlçe</label>
                <input type="text" class="form-control @error('default_district') is-invalid @enderror" id="default_district" name="default_district" value="{{ old('default_district', $user->default_district) }}">
                @error('default_district')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 mb-3">
                <label for="default_address" class="form-label">Adres</label>
                <textarea class="form-control @error('default_address') is-invalid @enderror" id="default_address" name="default_address" rows="3">{{ old('default_address', $user->default_address) }}</textarea>
                @error('default_address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>

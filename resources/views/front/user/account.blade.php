@extends('front.layouts.account')

@section('account_title', 'Hesap Bilgileri')
@section('account_subtitle', 'Hesap bilgilerinizi görüntüleyin ve düzenleyin')

@section('account_content')
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-xl font-semibold mb-6">Hesap Bilgileri</h2>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif
    
    <form action="{{ route('user.account.update') }}" method="POST" class="space-y-4">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Ad</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-primary focus:border-primary @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="surname" class="block text-sm font-medium text-gray-700 mb-1">Soyad</label>
                <input type="text" id="surname" name="surname" value="{{ $user->surname }}" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-primary focus:border-primary @error('surname') border-red-500 @enderror">
                @error('surname')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-posta</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-primary focus:border-primary @error('email') border-red-500 @enderror">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="pt-4 border-t">
            <h3 class="text-lg font-medium mb-4">Şifre Değiştir</h3>
            <div class="space-y-4">
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Mevcut Şifre</label>
                    <input type="password" id="current_password" name="current_password" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-primary focus:border-primary @error('current_password') border-red-500 @enderror">
                    @error('current_password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Yeni Şifre</label>
                        <input type="password" id="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-primary focus:border-primary @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Şifre Tekrar</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-primary focus:border-primary">
                    </div>
                </div>
            </div>
        </div>
        
        <div>
            <button type="submit" class="bg-primary text-white px-6 py-2 !rounded-button hover:bg-opacity-90 transition-all">
                Değişiklikleri Kaydet
            </button>
        </div>
    </form>
</div>
@endsection 
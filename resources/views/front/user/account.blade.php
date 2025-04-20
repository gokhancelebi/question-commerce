@extends('front.layouts.app')

@section('content')
<div class="pt-24 pb-16">
    <div class="container mx-auto max-w-6xl px-4">
        <div class="mb-8">
            <h1 class="text-3xl font-semibold mb-2">Hesabım</h1>
            <p class="text-gray-600">Hesap bilgilerinizi görüntüleyin ve düzenleyin</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Sidebar -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-4 border-b">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-white">
                                <i class="ri-user-line ri-lg"></i>
                            </div>
                            <div class="ml-3">
                                <p class="font-medium">{{ $user->name }} {{ $user->surname }}</p>
                                <p class="text-sm text-gray-500">{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="py-2">
                        <a href="{{ route('user.account') }}" class="flex items-center px-4 py-3 text-primary bg-gray-50">
                            <i class="ri-user-settings-line mr-3"></i>
                            <span>Hesap Bilgileri</span>
                        </a>
                        <a href="{{ route('user.orders') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50">
                            <i class="ri-history-line mr-3"></i>
                            <span>Siparişlerim</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="border-t">
                            @csrf
                            <button type="submit" class="w-full flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50">
                                <i class="ri-logout-box-line mr-3"></i>
                                <span>Çıkış Yap</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="md:col-span-3">
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
            </div>
        </div>
    </div>
</div>
@endsection 
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kayıt Ol</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 min-h-screen flex flex-col items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <a href="{{ url('/') }}" class="text-4xl font-['Pacifico'] text-primary inline-block mb-2">logo</a>
            <h1 class="text-2xl font-semibold text-gray-800">Kayıt Ol</h1>
            <p class="text-gray-600">Yeni bir hesap oluşturarak devam edin</p>
        </div>
        
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <form method="POST" action="{{ route('register') }}" class="p-6 space-y-4">
                @csrf
                
                @if(request()->has('redirect_back'))
                <input type="hidden" name="redirect_back" value="{{ request('redirect_back') }}">
                @endif
                
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Ad</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-user-line text-gray-400"></i>
                        </div>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="given-name"
                            class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary @error('name') border-red-500 @enderror"
                            placeholder="Adınız">
                    </div>
                    @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="surname" class="block text-sm font-medium text-gray-700 mb-1">Soyad</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-user-line text-gray-400"></i>
                        </div>
                        <input id="surname" type="text" name="surname" value="{{ old('surname') }}" required autocomplete="family-name"
                            class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary @error('surname') border-red-500 @enderror"
                            placeholder="Soyadınız">
                    </div>
                    @error('surname')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-posta</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-mail-line text-gray-400"></i>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                            class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary @error('email') border-red-500 @enderror"
                            placeholder="E-posta adresiniz">
                    </div>
                    @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Şifre</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-lock-line text-gray-400"></i>
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary @error('password') border-red-500 @enderror"
                            placeholder="Şifreniz (en az 8 karakter)">
                    </div>
                    @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Şifre Tekrar</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-lock-line text-gray-400"></i>
                        </div>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                            class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                            placeholder="Şifrenizi tekrar girin">
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="terms" name="terms" type="checkbox" value="agree" required
                            class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="terms" class="text-gray-700">
                            <a href="#" class="text-primary hover:underline">Kullanım şartlarını</a> kabul ediyorum
                        </label>
                    </div>
                    @error('terms')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <button type="submit" class="w-full bg-primary text-white py-2 rounded-md hover:bg-opacity-90 transition-all flex items-center justify-center">
                        <i class="ri-user-add-line mr-2"></i>
                        Kayıt Ol
                    </button>
                </div>
            </form>
            
            <div class="p-6 bg-gray-50 border-t border-gray-200 text-center">
                <p class="text-sm text-gray-600">
                    Zaten bir hesabınız var mı? 
                    <a href="{{ route('login', request()->only('redirect_back')) }}" class="text-primary hover:underline font-medium">
                        Giriş Yap
                    </a>
                </p>
            </div>
        </div>
        
        <div class="mt-8 text-center">
            <a href="{{ url('/') }}" class="text-gray-600 hover:text-gray-800 flex items-center justify-center">
                <i class="ri-arrow-left-line mr-2"></i>
                Ana Sayfaya Dön
            </a>
        </div>
    </div>
    
    @vite('resources/js/app.js')
</body>
</html> 
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Giriş Yap</title>

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
            <h1 class="text-2xl font-semibold text-gray-800">Giriş Yap</h1>
            <p class="text-gray-600">Hesabınızla giriş yaparak devam edin</p>
        </div>
        
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            @if(session('status'))
            <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 mb-4 rounded">
                {{ session('status') }}
            </div>
            @endif
            
            <form method="POST" action="{{ route('login') }}" class="p-6 space-y-4">
                @csrf
                
                @if(request()->has('redirect_back'))
                <input type="hidden" name="redirect_back" value="{{ request('redirect_back') }}">
                @endif
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-posta</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-mail-line text-gray-400"></i>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" 
                            class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary @error('email') border-red-500 @enderror" 
                            placeholder="E-posta adresinizi girin">
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
                        <input id="password" type="password" name="password" required autocomplete="current-password" 
                            class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary @error('password') border-red-500 @enderror"
                            placeholder="Şifrenizi girin">
                    </div>
                    @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                            class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Beni Hatırla
                        </label>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-sm text-primary hover:underline">
                        Şifremi unuttum
                    </a>
                </div>
                
                <div>
                    <button type="submit" class="w-full bg-primary text-white py-2 rounded-md hover:bg-opacity-90 transition-all flex items-center justify-center">
                        <i class="ri-login-box-line mr-2"></i>
                        Giriş Yap
                    </button>
                </div>
            </form>
            
            <div class="p-6 bg-gray-50 border-t border-gray-200 text-center">
                <p class="text-sm text-gray-600">
                    Hesabınız yok mu? 
                    <a href="{{ route('register', request()->only('redirect_back')) }}" class="text-primary hover:underline font-medium">
                        Yeni üyelik oluştur
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
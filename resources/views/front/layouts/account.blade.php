@extends('front.layouts.app')

@section('content')
<div class="pt-24 pb-16">
    <div class="container mx-auto max-w-6xl px-4">
        <div class="mb-8">
            <h1 class="text-3xl font-semibold mb-2">@yield('account_title')</h1>
            <p class="text-gray-600">@yield('account_subtitle')</p>
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
                                <p class="font-medium">{{ auth()->user()->name }} {{ auth()->user()->surname ?? '' }}</p>
                                <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="py-2">
                        <a href="{{ route('user.account') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 {{ request()->routeIs('user.account') ? 'text-primary bg-gray-50' : '' }}">
                            <i class="ri-user-settings-line mr-3"></i>
                            <span>Hesap Bilgileri</span>
                        </a>
                        <a href="{{ route('user.orders') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 {{ request()->routeIs('user.orders*') ? 'text-primary bg-gray-50' : '' }}">
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
                @yield('account_content')
            </div>
        </div>
    </div>
</div>
@endsection 
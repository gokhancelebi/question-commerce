<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class RegisterController extends Controller
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm(Request $request)
    {
        if (Auth::check()) {
            return redirect('/');
        }
        
        // Store previous URL for redirecting back after registration
        if (!$request->session()->has('url.intended')) {
            $referer = $request->headers->get('referer');
            if ($referer && $referer !== URL::route('login') && $referer !== URL::route('register')) {
                $request->session()->put('url.intended', $referer);
            }
        }
        
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms' => ['required', 'accepted']
        ], [
            'name.required' => 'Ad alanı zorunludur.',
            'surname.required' => 'Soyad alanı zorunludur.',
            'email.required' => 'E-posta alanı zorunludur.',
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'email.unique' => 'Bu e-posta adresi zaten kullanımda.',
            'password.required' => 'Şifre alanı zorunludur.',
            'password.min' => 'Şifre en az 8 karakter olmalıdır.',
            'password.confirmed' => 'Şifre tekrarı eşleşmiyor.',
            'terms.required' => 'Kullanım şartlarını kabul etmelisiniz.',
            'terms.accepted' => 'Kullanım şartlarını kabul etmelisiniz.'
        ]);

        $user = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        Auth::login($user);

        // Check for redirect_back parameter
        if ($request->has('redirect_back')) {
            return redirect($request->input('redirect_back'));
        }
        
        // Fallback to default redirect
        return redirect($this->redirectTo);
    }
    
    /**
     * Handle AJAX registration requests
     */
    public function ajaxRegister(Request $request)
    {
        $validationRules = [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'confirmPassword' => ['required', 'same:password'],
            'termsAccept' => ['required', 'accepted']
        ];
        
        $validationMessages = [
            'firstName.required' => 'Ad alanı zorunludur.',
            'lastName.required' => 'Soyad alanı zorunludur.',
            'email.required' => 'E-posta alanı zorunludur.',
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'email.unique' => 'Bu e-posta adresi zaten kullanımda.',
            'password.required' => 'Şifre alanı zorunludur.',
            'password.min' => 'Şifre en az 8 karakter olmalıdır.',
            'confirmPassword.same' => 'Şifre tekrarı eşleşmiyor.',
            'termsAccept.required' => 'Kullanım şartlarını kabul etmelisiniz.',
            'termsAccept.accepted' => 'Kullanım şartlarını kabul etmelisiniz.'
        ];
        
        try {
            $data = $request->validate($validationRules, $validationMessages);
            
            $user = User::create([
                'name' => $data['firstName'],
                'surname' => $data['lastName'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);
            
            Auth::login($user);
            
            // Determine the redirect URL from parameter
            $redirectUrl = $request->input('redirect_back', $this->redirectTo);
            
            return response()->json([
                'success' => true,
                'message' => 'Kayıt başarılı, yönlendiriliyorsunuz.',
                'redirect' => $redirectUrl
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Kayıt işlemi sırasında hatalar oluştu.',
                'errors' => $e->errors()
            ], 422);
        }
    }
} 
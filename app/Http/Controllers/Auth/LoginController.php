<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class LoginController extends Controller
{
    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(Request $request)
    {
        if (Auth::check()) {
            return redirect('/');
        }
        
        // Store previous URL for redirecting back after login
        if (!$request->session()->has('url.intended')) {
            $referer = $request->headers->get('referer');
            if ($referer && $referer !== URL::route('login') && $referer !== URL::route('register')) {
                $request->session()->put('url.intended', $referer);
            }
        }
        
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();
            
            // Check for redirect_back parameter
            if ($request->has('redirect_back')) {
                return redirect($request->input('redirect_back'));
            }
            
            // Fallback to default redirect
            return redirect($this->redirectTo);
        }

        return back()->withErrors([
            'email' => 'Girdiğiniz bilgiler kayıtlarımızla eşleşmiyor.',
        ])->withInput();
    }
    
    /**
     * Handle AJAX login requests
     */
    public function ajaxLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();
            
            // Determine the redirect URL from parameter
            $redirectUrl = $request->input('redirect_back', $this->redirectTo);
            
            return response()->json([
                'success' => true,
                'message' => 'Giriş başarılı, yönlendiriliyorsunuz.',
                'redirect' => $redirectUrl
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Girdiğiniz bilgiler kayıtlarımızla eşleşmiyor.'
        ], 422);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
} 
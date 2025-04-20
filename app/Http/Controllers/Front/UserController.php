<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display user account page
     *
     * @return \Illuminate\View\View
     */
    public function account()
    {
        $user = Auth::user();
        return view('front.user.account', compact('user'));
    }
    
    /**
     * Update user account information
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAccount(Request $request)
    {
        $user = Auth::user();
        
        // Validate the request data
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'current_password' => ['nullable', 'string'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);
        
        // Update basic information
        $user->name = $validated['name'];
        $user->surname = $validated['surname'];
        $user->email = $validated['email'];
        
        // Check if password change was requested
        if (!empty($validated['current_password']) && !empty($validated['password'])) {
            // Verify current password
            if (!Hash::check($validated['current_password'], $user->password)) {
                return back()->withErrors(['current_password' => 'Mevcut şifreniz doğru değil.']);
            }
            
            // Set new password
            $user->password = Hash::make($validated['password']);
        }
        
        $user->save();
        
        return redirect()->route('user.account')->with('success', 'Hesap bilgileriniz başarıyla güncellendi.');
    }
    
    /**
     * Display user orders
     *
     * @return \Illuminate\View\View
     */
    public function orders()
    {
        $user = Auth::user();
        // For now, just using an empty array for orders
        // In a real implementation, you would fetch orders from the database
        $orders = [];
        return view('front.user.orders', compact('user', 'orders'));
    }
} 
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show login page
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Try to find user by email or name
        $user = User::where('email', $credentials['username'])
                    ->orWhere('name', $credentials['username'])
                    ->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            
            // Redirect based on role
            if ($user->is_admin) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('homepage');
        }

        return back()->withErrors([
            'username' => 'Invalid username or password.',
        ])->withInput();
    }

    // Show signup page
    public function showSignup()
    {
        return view('auth.signup');
    }

    // Handle signup
    public function signup(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['fullname'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => false,
            'status' => 'active'
        ]);

        Auth::login($user);
        
        return redirect()->route('homepage');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }
}
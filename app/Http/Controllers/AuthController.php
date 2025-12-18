<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // Find user
        $user = User::where('email', $request->email)->first();

        // Check password (Hash::check handles the hashed password from DB)
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            
            if ($user->is_admin) {
                return redirect()->route('admin.dashboard');
            }
            
            return redirect()->route('homepage');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function showSignup()
    {
        return view('auth.signup');
    }

    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create user with PLAIN password (Model handles hashing)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, // <--- CHANGED: Removed Hash::make()
            'is_admin' => false,
            'status' => 'active'
        ]);

        Auth::login($user);

        return redirect()->route('homepage')->with('success', 'Account created successfully!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
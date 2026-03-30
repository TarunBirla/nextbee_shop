<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // REGISTER
    public function register(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'role' => 'required'
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
    ]);

    // ❌ remove Auth::login($user);
    // ✅ direct login page
    return redirect('/login')->with('success', 'Register success, please login');
}

    // LOGIN
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {

        // 🔥 ROLE BASED REDIRECT
        if (Auth::user()->role == 'bussiness_owner') {
            return redirect('/admin/dashboard');
        } else {
            return redirect('/');
        }
    }

    return back()->with('error', 'Invalid credentials');
}

    // LOGOUT
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    // PROFILE
    public function profile()
    {
        return view('auth.profile');
    }
    public function updateProfile(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email'
    ]);

    $user = auth()->user();

    $user->update([
        'name' => $request->name,
        'email' => $request->email
    ]);

    return back()->with('success', 'Profile updated successfully');
}
}

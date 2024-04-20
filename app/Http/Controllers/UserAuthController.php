<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;

class UserAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login_user');
    }

    public function login(Request $request)
    {
        // Validasi data yang dikirimkan oleh pengguna
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Proses otentikasi
        if (Auth::attempt($credentials)) {
            // Jika otentikasi berhasil, redirect ke halaman yang sesuai
            return redirect()->route('home');
        }

        // Jika otentikasi gagal, kembali ke halaman login dengan pesan kesalahan
        return redirect()->route('admin.login_user')->with('error', 'Invalid credentials');
    }
    
    public function showRegistrationUser()
    {
        return view('auth.register_user');
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins|unique:users',
            'password' => 'required|min:6',
            'user_type' => 'required|in:admin,user',
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_type' => $request->user_type,
        ];

        if ($request->user_type == 'admin') {
            Admin::create($userData);
        } elseif ($request->user_type == 'user') {
            User::create($userData);
        }

        return redirect('/login-user')->with('success', 'Registration successful! Please log in.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/home');
    }
}

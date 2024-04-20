<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login_admin');
    }

    public function login(Request $request)
    {
        // Validasi data yang dikirimkan oleh pengguna
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Proses otentikasi
        if (Auth::guard('admin')->attempt($credentials)) {
            // Jika otentikasi berhasil, redirect ke halaman yang sesuai
            return redirect()->route('index');
        }

        // Jika otentikasi gagal, kembali ke halaman login dengan pesan kesalahan
        return redirect()->route('auth.login_admin')->with('error', 'Invalid credentials');
    }

    public function showRegistrationAdmin()
    {
        return view('auth.register_admin');
    }

    public function registerAdmin(Request $request)
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

        return redirect('/login-admin')->with('success', 'Registration successful! Please log in.');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/index');
    }
}

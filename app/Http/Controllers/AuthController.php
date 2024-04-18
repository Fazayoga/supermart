<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginAdmin()
    {
        return view('auth.login_admin');
    }

    public function showLoginUser()
    {
        return view('auth.login_user');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'user_type' => 'admin'])) {
            return redirect()->route('index');
        } elseif (Auth::guard('web')->attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'user_type' => 'user'])) {
            return redirect()->route('home'); 
        } else {
            return redirect()->back()->withErrors(['Invalid credentials']);
        }
    }

    public function showRegistrationAdmin()
    {
        return view('auth.register_admin');
    }

    public function showRegistrationUser()
    {
        return view('auth.register_user');
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

    public function logoutAdmin()
    {
        Auth::guard('admin')->logout(); // Logout menggunakan guard 'admin'
        return redirect('/login-admin');
    }

    public function logoutUser()
    {
        Auth::guard('web')->logout();
        return redirect('/login-user');
    }
}
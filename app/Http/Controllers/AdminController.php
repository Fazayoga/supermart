<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function edit()
    {
        return view('admin.edit_admin');
    }

    public function profil()
    {
        return view('admin.profil');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admins,email,' . auth('admin')->user()->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $admins = Admin::find(auth('admin')->user()->id);

        if (!$admins) {
            // Handle the case where the admin user is not found
            return redirect()->route('admin.profil')->with('error', 'Admin user not found.');
        }

        $admins->saveProfile($request->name, $request->email, $request->password);

        return redirect()->route('admin.profil')->with('success', 'Profil berhasil diperbarui.');
    }
}

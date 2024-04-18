<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function edit()
    {
        return view('pages.edit-profil');
    }

    public function profil()
    {
        return view('pages.profil');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admins,email,' . auth('web')->user()->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user = User::find(auth('web')->user()->id);

        if (!$user) {
            // Handle the case where the admin user is not found
            return redirect()->route('pages.profil')->with('error', 'Admin user not found.');
        }

        $user->saveProfile($request->name, $request->email, $request->password);

        return redirect()->route('pages.profil')->with('success', 'Profil berhasil diperbarui.');
    }
}

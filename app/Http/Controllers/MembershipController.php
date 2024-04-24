<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\User;

class MembershipController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $user = auth()->user();
            $member = Member::where('users_id', $user->id)->first();
            return view('user.membership', ['member' => $member]);
        }
        return view('user.membership');
    }

    public function point()
    {
        if (auth()->check()) {
            $user = auth()->user();
            $member = Member::where('users_id', $user->id)->first();
            return view('user.point', ['member' => $member]);
        }
    }

    public function create()
    {
        return view('user.register_member');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
            'point' => 'nullable|integer|max:15',
        ]);

        // Dapatkan id pengguna yang saat ini diautentikasi
        $userId = auth()->id();

        // Buat entri baru dalam database untuk pengguna yang mendaftar
        Member::create(array_merge($validatedData, ['users_id' => $userId]));

        return redirect()->route('membership.index')->with('success', 'Member berhasil ditambahkan.');
    }
    public function register(Request $request)
    {
        // Validasi input dari formulir pendaftaran
        $validatedData = $request->validate([
           'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
            'point' => 'nullable|integer|max:15',
        ]);

        $user = auth()->user();

        // Buat entri baru dalam database untuk pengguna yang mendaftar
        $member = Member::create(array_merge($validatedData, ['users_id' => $user->id]));

        // Redirect ke halaman keanggotaan dengan data pengguna baru
        return redirect()->route('membership.index')->with('success', 'Pendaftaran keanggotaan berhasil!');
    }


    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('user.edit_membership', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
        ]);

        Member::whereId($id)->update($validatedData);

        return redirect()->route('membership.index')->with('success', 'Member berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Member::findOrFail($id)->delete();
        return redirect()->route('membership.index')->with('success', 'Member berhasil dihapus.');
    }
}

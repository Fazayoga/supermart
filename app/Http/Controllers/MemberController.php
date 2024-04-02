<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();
        return view('admin.member', compact('members'));
    }

    public function create()
    {
        return view('admin.create_member');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
            'point' => 'required|integer|max:15',
        ]);

        Member::create($validatedData);

        return redirect()->route('member.index')->with('success', 'Member berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('admin.edit_member', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
            'point' => 'required|integer|max:15',
        ]);

        Member::whereId($id)->update($validatedData);

        return redirect()->route('member.index')->with('success', 'Member berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Member::findOrFail($id)->delete();
        return redirect()->route('member.index')->with('success', 'Member berhasil dihapus.');
    }
}

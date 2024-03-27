<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diskon;

class DiskonController extends Controller
{
    public function index()
    {
        $diskon = Diskon::all();
        return view('admin.diskon', ['diskon' => $diskon]);
    }

    public function create()
    {
        return view('admin.create_diskon');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'besar_diskon' => 'required|numeric',
        ]);

        Diskon::create([
            'nama' => $request->nama,
            'besar_diskon' => $request->besar_diskon,
        ]);

        return redirect()->route('diskon.index')->with('success', 'Diskon berhasil disimpan.');
    }

    public function edit($id)
    {
        $diskon = Diskon::find($id);
        return view('admin.diskon.edit', ['diskon' => $diskon]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'besar_diskon' => 'required|numeric',
        ]);

        $diskon = Diskon::find($id);
        $diskon->update([
            'nama' => $request->nama,
            'besar_diskon' => $request->besar_diskon,
        ]);

        return redirect()->route('diskon.index')->with('success', 'Diskon berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $diskon = Diskon::find($id);
        $diskon->delete();

        return redirect()->route('diskon.index')->with('success', 'Diskon berhasil dihapus.');
    }
}

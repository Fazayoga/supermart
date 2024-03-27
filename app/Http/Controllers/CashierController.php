<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use Illuminate\Http\Request;


class CashierController extends Controller
{
    public function index()
    {
        $cashier = Cashier::all();
        return view('cashier.index', compact('cashier'));
    }

    public function create()
    {
        return view('cashier.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Cashier::create($request->all());

        return redirect()->route('cashier.index')->with('success', 'Cashier created successfully.');
    }

    public function show(Cashier $cashier)
    {
        return view('cashier.show', compact('cashier'));
    }

    public function edit(Cashier $cashier)
    {
        return view('cashier.edit', compact('cashier'));
    }

    public function update(Request $request, Cashier $cashier)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $cashier->update($request->all());

        return redirect()->route('cashier.index')->with('success', 'Cashier updated successfully.');
    }

    public function destroy(Cashier $cashier)
    {
        $cashier->delete();

        return redirect()->route('cashier.index')->with('success', 'Cashier deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;

class ShippingMethodController extends Controller
{
    public function index()
    {
        $shippingMethods = ShippingMethod::latest()->paginate(10);
        return view('admin.shipping-methods.index', compact('shippingMethods'));
    }

    public function create()
    {
        return view('admin.shipping-methods.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        ShippingMethod::create([
            'name' => $request->name,
            'cost' => $request->cost,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.shipping-methods.index')->with('success', 'Metode pengiriman berhasil ditambahkan.');
    }

    public function edit(ShippingMethod $shippingMethod)
    {
        return view('admin.shipping-methods.edit', compact('shippingMethod'));
    }

    public function update(Request $request, ShippingMethod $shippingMethod)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        $shippingMethod->update([
            'name' => $request->name,
            'cost' => $request->cost,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.shipping-methods.index')->with('success', 'Metode pengiriman berhasil diperbarui.');
    }

    public function destroy(ShippingMethod $shippingMethod)
    {
        $shippingMethod->delete();
        return redirect()->route('admin.shipping-methods.index')->with('success', 'Metode pengiriman berhasil dihapus.');
    }
}

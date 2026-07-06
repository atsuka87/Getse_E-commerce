<?php

namespace App\Http\Controllers;

use App\Models\WarrantyClaim;
use App\Models\WarrantyClaimImage;
use App\Models\Order;
use Illuminate\Http\Request;

class WarrantyClaimController extends Controller
{
    public function create(Request $request)
    {
        $orders = auth()->user()->orders()
            ->where('status', 'completed')
            ->with(['items.product.warranties'])
            ->get();

        return view('warranty-claims.create', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'warranty_id' => 'required|exists:warranties,id',
            'issue_description' => 'required|string|max:2000',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $order = Order::where('id', $request->order_id)
            ->where('user_id', auth()->id())
            ->where('status', 'completed')
            ->firstOrFail();

        if ($order->completed_at && $order->completed_at->diffInDays(now()) > 7) {
            return back()->with('error', 'Pesanan telah melewati 7 hari. Garansi toko sudah habis, silakan hubungi supplier secara langsung.');
        }

        $claim = WarrantyClaim::create([
            'user_id' => auth()->id(),
            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
            'warranty_id' => $request->warranty_id,
            'issue_description' => $request->issue_description,
            'status' => 'submitted',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('warranty-claim-images', 'public');
                WarrantyClaimImage::create([
                    'warranty_claim_id' => $claim->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('warranty-claims.index')
            ->with('success', 'Klaim garansi berhasil diajukan!');
    }

    public function index()
    {
        $claims = auth()->user()->warrantyClaims()
            ->with(['product.primaryImage', 'warranty', 'images'])
            ->latest()
            ->paginate(10);

        return view('warranty-claims.index', compact('claims'));
    }

    public function show(WarrantyClaim $warrantyClaim)
    {
        if ($warrantyClaim->user_id !== auth()->id()) {
            abort(403);
        }

        $warrantyClaim->load(['product.primaryImage', 'warranty', 'images', 'order']);

        return view('warranty-claims.show', compact('warrantyClaim'));
    }
}

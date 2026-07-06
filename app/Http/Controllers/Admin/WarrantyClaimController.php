<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WarrantyClaim;
use Illuminate\Http\Request;

class WarrantyClaimController extends Controller
{
    public function index(Request $request)
    {
        $query = WarrantyClaim::with(['user', 'product.primaryImage', 'warranty']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $claims = $query->latest()->paginate(15);

        return view('admin.warranty-claims.index', compact('claims'));
    }

    public function show(WarrantyClaim $warrantyClaim)
    {
        $warrantyClaim->load(['user', 'product.primaryImage', 'warranty', 'images', 'order']);
        return view('admin.warranty-claims.show', compact('warrantyClaim'));
    }

    public function updateStatus(Request $request, WarrantyClaim $warrantyClaim)
    {
        $request->validate([
            'status' => 'required|in:under_review,approved,rejected,in_repair,completed',
            'admin_notes' => 'nullable|string',
            'resolution' => 'nullable|string',
        ]);

        $data = [
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
        ];

        if (in_array($request->status, ['completed', 'rejected'])) {
            $data['resolved_at'] = now();
            $data['resolution'] = $request->resolution;
        }

        $warrantyClaim->update($data);

        return back()->with('success', 'Status klaim garansi berhasil diperbarui!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'payment']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('order_number', 'like', "%{$request->search}%")
                  ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$request->search}%"));
            });
        }

        $orders = $query->latest()->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.product.primaryImage', 'payment.proofs']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,awaiting_payment,payment_verification,processing,shipped,delivered,completed,cancelled,refunded',
            'tracking_number' => 'nullable|string|max:255',
            'shipping_courier' => 'nullable|string|max:255',
        ]);

        $data = ['status' => $request->status];

        if ($request->status === 'shipped') {
            $data['shipped_at'] = now();
            $data['tracking_number'] = $request->tracking_number;
            $data['shipping_courier'] = $request->shipping_courier;
        } elseif ($request->status === 'delivered') {
            $data['delivered_at'] = now();
        } elseif ($request->status === 'completed') {
            $data['completed_at'] = now();
        } elseif ($request->status === 'cancelled') {
            $data['cancelled_at'] = now();
            // Restore stock
            foreach ($order->items as $item) {
                $item->product->increment('stock', $item->quantity);
            }
        }

        $order->update($data);

        return back()->with('success', 'Status order berhasil diperbarui!');
    }

    public function verifyPayment(Request $request, Order $order)
    {
        $request->validate([
            'action' => 'required|in:verify,reject',
            'admin_notes' => 'nullable|string',
        ]);

        $payment = $order->payment;

        if ($request->action === 'verify') {
            $payment->update([
                'status' => 'verified',
                'verified_at' => now(),
                'verified_by' => auth()->id(),
                'admin_notes' => $request->admin_notes,
            ]);
            $order->update([
                'status' => 'processing',
                'paid_at' => now(),
            ]);
            $message = 'Pembayaran berhasil diverifikasi!';
        } else {
            $payment->update([
                'status' => 'rejected',
                'admin_notes' => $request->admin_notes,
                'verified_by' => auth()->id(),
            ]);
            $order->update(['status' => 'awaiting_payment']);
            $message = 'Pembayaran ditolak.';
        }

        return back()->with('success', $message);
    }
}

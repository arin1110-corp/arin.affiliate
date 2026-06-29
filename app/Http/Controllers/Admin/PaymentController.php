<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModelPayment;
use App\Models\ModelUser;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = ModelPayment::with('user')
            ->latest('payment_id')
            ->paginate(20);

        return view(
            'admin.payment.index',
            compact('payments')
        );
    }

    public function show($id)
    {
        $payment = ModelPayment::with('user')
            ->findOrFail($id);

        return view(
            'admin.payment.show',
            compact('payment')
        );
    }

    public function approve($id)
    {
        $payment = ModelPayment::findOrFail($id);

        $payment->update([
            'payment_status' => 'paid',
            'approved_at' => now(),
            'paid_at' => now(),
            'expired_at' => now()->addMonth(),
        ]);

        $user = ModelUser::find(
            $payment->user_id
        );

        if ($user) {
            $user->update([
                'user_payment_status' => 'paid',
                'user_last_payment_at' => now(),
                'user_next_billing_at' => now()->addMonth(),
                'user_expired_at' => now()->addMonth(),
                'user_is_active' => true,
            ]);
        }

        return back()->with(
            'success',
            'Pembayaran berhasil disetujui.'
        );
    }

    public function reject($id)
    {
        $payment = ModelPayment::findOrFail($id);

        $payment->update([
            'payment_status' => 'rejected',
        ]);

        $user = ModelUser::find(
            $payment->user_id
        );

        if ($user) {
            $user->update([
                'user_payment_status' => 'failed',
            ]);
        }

        return back()->with(
            'success',
            'Pembayaran berhasil ditolak.'
        );
    }
}
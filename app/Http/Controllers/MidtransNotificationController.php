<?php

namespace App\Http\Controllers;

use App\Models\ModelPayment;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransNotificationController extends Controller
{
    public function handle(Request $request)
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = (bool) config('services.midtrans.is_production');
        Config::$isSanitized = (bool) config('services.midtrans.is_sanitized');
        Config::$is3ds = (bool) config('services.midtrans.is_3ds');

        $notification = new Notification();

        $orderId = $notification->order_id;
        $transactionStatus = $notification->transaction_status;
        $fraudStatus = $notification->fraud_status ?? null;

        $payment = ModelPayment::where('midtrans_order_id', $orderId)->first();

        if (!$payment) {
            return response()->json([
                'message' => 'Payment not found',
            ], 404);
        }

        $payment->update([
            'midtrans_transaction_id' => $notification->transaction_id ?? null,
            'midtrans_payment_type' => $notification->payment_type ?? null,
            'midtrans_transaction_status' => $transactionStatus,
            'midtrans_fraud_status' => $fraudStatus,
        ]);

        if ($this->isSuccess($transactionStatus, $fraudStatus)) {
            $this->approvePayment($payment);
        }

        if (in_array($transactionStatus, ['deny', 'cancel', 'expire'])) {
            $payment->update([
                'payment_status' => 'rejected',
                'payment_note' => 'Midtrans status: ' . $transactionStatus,
                'expired_at' => $transactionStatus === 'expire' ? now() : $payment->expired_at,
            ]);
        }

        return response()->json([
            'message' => 'Notification handled',
        ]);
    }

    private function isSuccess($transactionStatus, $fraudStatus): bool
    {
        if ($transactionStatus === 'settlement') {
            return true;
        }

        if ($transactionStatus === 'capture' && $fraudStatus === 'accept') {
            return true;
        }

        return false;
    }

    private function approvePayment(ModelPayment $payment): void
    {
        if ($payment->payment_status === 'approved') {
            return;
        }

        $user = $payment->user;

        $startDate = now();

        if ($user->user_expired_at && $user->user_expired_at->greaterThan(now())) {
            $startDate = $user->user_expired_at;
        }

        $user->update([
            'user_is_active' => true,
            'user_is_trial' => false,
            'user_expired_at' => $startDate->copy()->addMonth(),
        ]);

        $payment->update([
            'payment_status' => 'approved',
            'paid_at' => now(),
            'approved_at' => now(),
            'payment_note' => 'Pembayaran otomatis disetujui oleh Midtrans.',
        ]);
    }
}
<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ModelPayment;
use App\Models\ModelUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;
use App\Models\ModelPaymentSetting;

class PaymentController extends Controller
{
    public function checkout()
    {
        $user = Auth::guard('arin')->user();

        if ($user->user_payment_status === 'paid' && $user->user_is_setup_done) {
            return redirect()->route('client.dashboard');
        }

        $setting = ModelPaymentSetting::first();

        if (!$setting) {
            abort(500, 'Payment setting belum dibuat.');
        }

        if ($setting->payment_gateway === 'manual') {
            return view('client.payment.manual', compact('user', 'setting'));
        }

        return view('client.payment.checkout', compact('user', 'setting'));
    }

    public function process()
    {
        $user = Auth::guard('arin')->user();

        $setting = ModelPaymentSetting::first();

        Config::$serverKey = $setting->midtrans_server_key;

        Config::$isProduction = $setting->midtrans_is_production;

        Config::$isSanitized = true;
        Config::$is3ds = true;

        $price = $user->user_package === 'pro' ? 99900 : 17900;

        $invoice = 'AFF-' . now()->format('YmdHis') . '-' . $user->user_id;

        $payment = ModelPayment::create([
            'user_id' => $user->user_id,
            'payment_invoice' => $invoice,
            'payment_package' => $user->user_package,
            'payment_amount' => $price,
            'payment_status' => 'pending',
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => $invoice,
                'gross_amount' => $price,
            ],

            'customer_details' => [
                'first_name' => $user->user_nama,
                'email' => $user->user_email,
            ],

            'callbacks' => [
                'finish' => route('client.payment.finish'),
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        $payment->update([
            'midtrans_order_id' => $invoice,
            'midtrans_snap_token' => $snapToken,
        ]);

        $user->update([
            'user_invoice_number' => $invoice,
            'user_payment_status' => 'pending',
        ]);

        return response()->json([
            'snap_token' => $snapToken,
        ]);
    }

    public function finish()
    {
        return redirect()->route('client.payment.waiting');
    }

    public function waiting()
    {
        $user = Auth::guard('arin')->user();

        $payment = ModelPayment::where('user_id', $user->user_id)->latest('payment_id')->first();

        if ($user->user_payment_status === 'paid') {
            return redirect()->route('client.setup.index')->with('success', 'Pembayaran berhasil.');
        }

        return view('client.payment.waiting', compact('payment'));
    }

    public function callback(Request $request)
    {
        $setting = ModelPaymentSetting::first();

        Config::$serverKey = $setting->midtrans_server_key;

        Config::$isProduction = $setting->midtrans_is_production;

        $notification = new Notification();

        $invoice = $notification->order_id;

        $status = $notification->transaction_status;

        $paymentType = $notification->payment_type;

        $fraudStatus = $notification->fraud_status;

        $payment = ModelPayment::where('payment_invoice', $invoice)->first();

        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Invoice tidak ditemukan.',
            ]);
        }

        $user = ModelUser::find($payment->user_id);

        $payment->update([
            'midtrans_transaction_id' => $notification->transaction_id,

            'midtrans_payment_type' => $paymentType,

            'midtrans_transaction_status' => $status,

            'midtrans_fraud_status' => $fraudStatus,

            'payment_method' => $paymentType,
        ]);

        if ($status === 'capture' || $status === 'settlement') {
            $payment->update([
                'payment_status' => 'paid',

                'paid_at' => now(),

                'approved_at' => now(),

                'expired_at' => now()->addMonth(),
            ]);

            $user->update([
                'user_payment_status' => 'paid',

                'user_last_payment_at' => now(),

                'user_next_billing_at' => now()->addMonth(),

                'user_expired_at' => now()->addMonth(),

                'user_is_active' => true,
            ]);
        }

        if ($status === 'pending') {
            $payment->update([
                'payment_status' => 'pending',
            ]);

            $user->update([
                'user_payment_status' => 'pending',
            ]);
        }

        if ($status === 'expire' || $status === 'cancel' || $status === 'deny') {
            $payment->update([
                'payment_status' => 'failed',
            ]);

            $user->update([
                'user_payment_status' => 'failed',
            ]);
        }

        return response()->json([
            'success' => true,
        ]);
    }
    public function check()
    {
        $user = Auth::guard('arin')->user();

        return response()->json([
            'status' => $user->user_payment_status,
        ]);
    }
    public function manualStore(Request $request)
    {
        $user = Auth::guard('arin')->user();

        $request->validate([
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $price = $user->user_package === 'pro' ? 99900 : 17900;

        $invoice = 'AFF-' . now()->format('YmdHis') . '-' . $user->user_id;

        $path = null;

        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');

            $name = time() . '_' . $user->user_id . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads/payment-proof'), $name);

            $path = 'uploads/payment-proof/' . $name;
        }

        ModelPayment::create([
            'user_id' => $user->user_id,

            'payment_invoice' => $invoice,

            'payment_package' => $user->user_package,

            'payment_amount' => $price,

            'payment_method' => 'manual',

            'payment_proof' => $path,

            'payment_status' => 'pending',
        ]);

        $user->update([
            'user_invoice_number' => $invoice,

            'user_payment_status' => 'pending',
        ]);

        return redirect()->route('client.payment.waiting')->with('success', 'Bukti pembayaran berhasil dikirim.');
    }
    public function history()
    {
        $user = Auth::guard('arin')->user();

        $payments = ModelPayment::where('user_id', $user->user_id)->latest()->paginate(10);

        return view('client.payment.history', compact('payments'));
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

        $user = $payment->user;

        $user->update([
            'user_payment_status' => 'paid',
            'user_last_payment_at' => now(),
            'user_next_billing_at' => now()->addMonth(),
            'user_expired_at' => now()->addMonth(),
            'user_is_active' => true,
        ]);

        return back()->with('success', 'Pembayaran berhasil disetujui.');
    }

    public function reject($id)
    {
        $payment = ModelPayment::findOrFail($id);

        $payment->update([
            'payment_status' => 'failed',
        ]);

        $payment->user->update([
            'user_payment_status' => 'failed',
        ]);

        return back()->with('success', 'Pembayaran ditolak.');
    }
}
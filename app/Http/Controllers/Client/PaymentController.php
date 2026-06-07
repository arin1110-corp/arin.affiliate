<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ModelPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function index()
    {
        $user = Auth::guard('arin')->user();

        $data = ModelPayment::where('user_id', $user->user_id)
            ->latest('payment_id')
            ->get();

        return view('client.payment.index', compact('data', 'user'));
    }

    public function create()
    {
        $user = Auth::guard('arin')->user();

        $amount = $this->getCurrentAmount($user);

        return view('client.payment.create', compact('user', 'amount'));
    }

    public function store(Request $request)
    {
        $user = Auth::guard('arin')->user();

        $amount = $this->getCurrentAmount($user);

        $invoice = 'INV-' . now()->format('YmdHis') . '-' . $user->user_id;
        $orderId = 'ARIN-' . now()->format('YmdHis') . '-' . $user->user_id;

        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = (bool) config('services.midtrans.is_production');
        Config::$isSanitized = (bool) config('services.midtrans.is_sanitized');
        Config::$is3ds = (bool) config('services.midtrans.is_3ds');

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $amount,
            ],
            'customer_details' => [
                'first_name' => $user->user_nama,
                'email' => $user->user_email,
                'phone' => $user->user_whatsapp,
            ],
            'item_details' => [
                [
                    'id' => $user->user_package,
                    'price' => (int) $amount,
                    'quantity' => 1,
                    'name' => 'ARIN Paket ' . ucfirst($user->user_package),
                ],
            ],
        ];

        $snap = Snap::createTransaction($params);

        ModelPayment::create([
            'user_id' => $user->user_id,
            'payment_invoice' => $invoice,
            'midtrans_order_id' => $orderId,
            'midtrans_snap_token' => $snap->token,
            'midtrans_redirect_url' => $snap->redirect_url,
            'payment_package' => $user->user_package,
            'payment_amount' => $amount,
            'payment_method' => 'Midtrans',
            'payment_status' => 'waiting_confirmation',
        ]);

        return redirect($snap->redirect_url);
    }

    private function getCurrentAmount($user)
    {
        if (
            $user->user_is_promo
            && $user->user_promo_until
            && now()->lessThanOrEqualTo($user->user_promo_until)
        ) {
            return $user->user_promo_price ?? 14900;
        }

        if ($user->user_package === 'pro') {
            return 99900;
        }

        return 49900;
    }
}
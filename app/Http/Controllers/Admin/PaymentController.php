<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModelPayment;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = ModelPayment::with('user')->latest('payment_id')->paginate(20);

        return view('admin.payment.index', compact('payments'));
    }

    public function show($id)
    {
        $payment = ModelPayment::with('user')->findOrFail($id);

        return view('admin.payment.show', compact('payment'));
    }
}
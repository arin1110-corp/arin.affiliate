<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModelPayment;

class PaymentController extends Controller
{
    public function index()
    {
        $data = ModelPayment::with('user')
            ->latest('payment_id')
            ->get();

        return view('admin.payment.index', compact('data'));
    }

    public function show($id)
    {
        $item = ModelPayment::with('user')
            ->where('payment_id', $id)
            ->firstOrFail();

        return view('admin.payment.show', compact('item'));
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModelPaymentSetting;
use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{
    public function index()
    {
        $setting = ModelPaymentSetting::first();

        if (!$setting) {
            $setting = ModelPaymentSetting::create([]);
        }

        return view('admin.payment-setting.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'payment_qris_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',

            'payment_bank_name' => 'nullable|string|max:100',
            'payment_bank_number' => 'nullable|string|max:100',
            'payment_bank_holder' => 'nullable|string|max:150',

            'payment_bank_name_2' => 'nullable|string|max:100',
            'payment_bank_number_2' => 'nullable|string|max:100',
            'payment_bank_holder_2' => 'nullable|string|max:150',

            'payment_whatsapp' => 'nullable|string|max:30',
            'payment_note' => 'nullable|string',
        ]);

        $setting = ModelPaymentSetting::first();

        if (!$setting) {
            $setting = ModelPaymentSetting::create([]);
        }

        $data = $request->only([
            'payment_bank_name',
            'payment_bank_number',
            'payment_bank_holder',
            'payment_bank_name_2',
            'payment_bank_number_2',
            'payment_bank_holder_2',
            'payment_whatsapp',
            'payment_note',
        ]);

        if ($request->hasFile('payment_qris_image')) {
            $file = $request->file('payment_qris_image');
            $name = time() . '_qris.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads/payment-setting'), $name);

            $data['payment_qris_image'] = 'uploads/payment-setting/' . $name;
        }

        $setting->update($data);

        return back()->with('success', 'Setting pembayaran berhasil disimpan.');
    }
}
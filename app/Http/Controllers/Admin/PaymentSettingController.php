<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModelPaymentSetting;
use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{
    public function index()
    {
        $setting =
            ModelPaymentSetting::first();

        if (!$setting) {
            $setting =
                ModelPaymentSetting::create([]);
        }

        return view(
            'admin.payment-setting.index',
            compact('setting')
        );
    }

    public function update(Request $request)
    {
        $setting =
            ModelPaymentSetting::first();

        if (!$setting) {
            $setting =
                ModelPaymentSetting::create([]);
        }

        $data =
            $request->validate([

            'payment_gateway'
            => 'required|in:manual,midtrans',

            'payment_bank_name'
            => 'nullable',

            'payment_bank_number'
            => 'nullable',

            'payment_bank_holder'
            => 'nullable',

            'payment_bank_name_2'
            => 'nullable',

            'payment_bank_number_2'
            => 'nullable',

            'payment_bank_holder_2'
            => 'nullable',

            'payment_bank_name_3'
            => 'nullable',

            'payment_bank_number_3'
            => 'nullable',

            'payment_bank_holder_3'
            => 'nullable',

            'payment_whatsapp'
            => 'nullable',

            'payment_note'
            => 'nullable',

            'midtrans_server_key'
            => 'nullable',

            'midtrans_client_key'
            => 'nullable',
        ]);

        $data['midtrans_is_production'] =
            $request->has(
                'midtrans_is_production'
            );

        if (
            $request->hasFile(
                'payment_qris_image'
            )
        ) {
            $file =
                $request->file(
                    'payment_qris_image'
                );

            $name =
                time()
                . '_qris.'
                . $file
                ->getClientOriginalExtension();

            $file->move(
                public_path(
                    'uploads/payment'
                ),
                $name
            );

            $data['payment_qris_image'] =
                'uploads/payment/'
                . $name;
        }

        $setting->update($data);

        return back()->with(
            'success',
            'Setting pembayaran berhasil disimpan.'
        );
    }
}
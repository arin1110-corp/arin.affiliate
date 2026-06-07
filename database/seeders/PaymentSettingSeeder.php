<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModelPaymentSetting;

class PaymentSettingSeeder extends Seeder
{
    public function run(): void
    {
        ModelPaymentSetting::updateOrCreate(
            ['setting_id' => 1],
            [
                'payment_qris_image' => null,

                'payment_bank_name' => 'BCA',
                'payment_bank_number' => '1234567890',
                'payment_bank_holder' => 'ARIN Digital',

                'payment_bank_name_2' => 'Mandiri',
                'payment_bank_number_2' => '1234567890',
                'payment_bank_holder_2' => 'ARIN Digital',

                'payment_whatsapp' => '6281234567890',
                'payment_note' => 'Setelah transfer, upload bukti pembayaran melalui halaman pembayaran.',
            ]
        );
    }
}
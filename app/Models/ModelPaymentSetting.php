<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelPaymentSetting extends Model
{
    protected $table =
    'arin_payment_settings';

    protected $primaryKey =
    'setting_id';

    protected $fillable = [

        /*
        |--------------------------------------------------------------------------
        | Gateway
        |--------------------------------------------------------------------------
        */

        'payment_gateway',

        /*
        |--------------------------------------------------------------------------
        | Manual Payment
        |--------------------------------------------------------------------------
        */

        'payment_qris_image',

        'payment_bank_name',
        'payment_bank_number',
        'payment_bank_holder',

        'payment_bank_name_2',
        'payment_bank_number_2',
        'payment_bank_holder_2',

        'payment_bank_name_3',
        'payment_bank_number_3',
        'payment_bank_holder_3',

        'payment_whatsapp',
        'payment_note',

        /*
        |--------------------------------------------------------------------------
        | Midtrans
        |--------------------------------------------------------------------------
        */

        'midtrans_server_key',
        'midtrans_client_key',
        'midtrans_is_production',
    ];

    protected $casts = [
        'midtrans_is_production'
        => 'boolean',
    ];
}
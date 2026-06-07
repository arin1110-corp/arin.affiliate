<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelPaymentSetting extends Model
{
    protected $table = 'arin_payment_settings';
    protected $primaryKey = 'setting_id';

    protected $fillable = [
        'payment_qris_image',
        'payment_bank_name',
        'payment_bank_number',
        'payment_bank_holder',
        'payment_bank_name_2',
        'payment_bank_number_2',
        'payment_bank_holder_2',
        'payment_whatsapp',
        'payment_note',
    ];
}
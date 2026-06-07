<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelPayment extends Model
{
    use SoftDeletes;

    protected $table = 'arin_payments';
    protected $primaryKey = 'payment_id';

    protected $fillable = [
        'user_id',
        'payment_invoice',
        'midtrans_order_id',
        'midtrans_transaction_id',
        'midtrans_payment_type',
        'midtrans_transaction_status',
        'midtrans_fraud_status',
        'midtrans_snap_token',
        'midtrans_redirect_url',
        'payment_package',
        'payment_amount',
        'payment_method',
        'payment_proof',
        'payment_status',
        'payment_note',
        'paid_at',
        'approved_at',
        'expired_at',
    ];

    protected $casts = [
        'payment_amount' => 'decimal:0',
        'paid_at' => 'datetime',
        'approved_at' => 'datetime',
        'expired_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(ModelUser::class, 'user_id', 'user_id');
    }
}
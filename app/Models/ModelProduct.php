<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelProduct extends Model
{
    use SoftDeletes;

    protected $table = 'arin_products';
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'user_id',
        'product_kategori',
        'product_nama',
        'product_slug',
        'product_thumbnail',
        'product_harga',
        'product_deskripsi',
        'product_affiliate_link',
        'product_total_click',
        'product_featured',
        'product_status',
        'product_link_shopee',
        'product_link_tokopedia',
        'product_link_lazada',
        'product_link_tiktok',
        'product_link_blibli',
        'product_link_bukalapak',
    ];

    protected $casts = [
        'product_featured' => 'boolean',
        'product_harga' => 'decimal:0',
    ];

    public function user()
    {
        return $this->belongsTo(ModelUser::class, 'user_id', 'user_id');
    }

    public function kategori()
    {
        return $this->belongsTo(ModelKategori::class, 'product_kategori', 'kategori_id');
    }
}
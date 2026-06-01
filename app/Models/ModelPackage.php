<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModelPackage extends Model
{
    use HasFactory;

    protected $table = 'arin_packages';
    protected $primaryKey = 'package_id';

    protected $fillable = [
        'package_nama',
        'package_slug',
        'package_harga_promo',
        'package_harga_normal',
        'package_masa_aktif',
        'package_max_product',
        'package_max_category',
        'package_custom_domain',
        'package_google_analytics',
        'package_meta_pixel',
        'package_deskripsi',
        'package_fitur',
        'package_is_active',
        'package_sort_order',
    ];

    protected $casts = [
        'package_custom_domain' => 'boolean',
        'package_google_analytics' => 'boolean',
        'package_meta_pixel' => 'boolean',
        'package_is_active' => 'boolean',
    ];
}
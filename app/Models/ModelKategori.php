<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelKategori extends Model
{
    use SoftDeletes;

    protected $table = 'arin_kategori';
    protected $primaryKey = 'kategori_id';

    protected $fillable = [
        'user_id',
        'kategori_nama',
        'kategori_slug',
        'kategori_deskripsi',
        'kategori_thumbnail',
        'kategori_meta_title',
        'kategori_meta_description',
        'kategori_is_active',
        'kategori_is_visible',
        'kategori_sort_order',
    ];

    protected $casts = [
        'kategori_is_active' => 'boolean',
        'kategori_is_visible' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(ModelUser::class, 'user_id', 'user_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelSlider extends Model
{
    use SoftDeletes;

    protected $table = 'arin_sliders';
    protected $primaryKey = 'slider_id';

    protected $fillable = [
        'user_id',
        'slider_judul',
        'slider_subjudul',
        'slider_image',
        'slider_image_mobile',
        'slider_link',
        'slider_sort_order',
        'slider_is_active',
    ];

    protected $casts = [
        'slider_is_active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(ModelUser::class, 'user_id', 'user_id');
    }
}
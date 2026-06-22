<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelSetting extends Model
{
    protected $table = 'arin_settings';
    protected $primaryKey = 'setting_id';

    protected $fillable = [
        'app_name',
        'app_logo',
        'app_favicon',
        'support_email',
        'support_whatsapp',
        'footer_text',
    ];
}
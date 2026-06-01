<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelLandingSetting extends Model
{
    protected $table = 'arin_landing_settings';
    protected $primaryKey = 'landing_id';

    protected $fillable = [
        'site_name',
        'site_tagline',
        'site_description',
        'hero_title',
        'hero_subtitle',
        'hero_image',
        'cta_text',
        'cta_link',
        'whatsapp_number',
        'primary_color',
        'secondary_color',
        'accent_color',
        'section_features',
        'section_faq',
    ];
}
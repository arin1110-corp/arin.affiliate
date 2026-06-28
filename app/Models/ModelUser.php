<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelUser extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $table = 'arin_users';
    protected $primaryKey = 'user_id';

    protected $fillable = ['user_nama', 'user_email', 'email_verified_at', 'user_email_verified_at', 'user_email_verify_token', 'user_password', 'user_slug', 'user_brand_name', 'user_tagline', 'user_description', 'user_logo', 'user_favicon', 'user_meta_title', 'user_meta_description', 'user_theme_accent', 'user_footer_text', 'user_whatsapp', 'user_instagram', 'user_tiktok', 'user_theme_primary', 'user_theme_secondary', 'user_is_setup_done', 'user_domain', 'user_subdomain', 'user_role', 'user_package', 'user_is_promo', 'user_promo_batch', 'user_promo_price', 'user_package_started_at', 'user_promo_until', 'user_is_trial', 'user_trial_end_at', 'user_expired_at', 'user_is_active'];

    protected $hidden = ['user_password'];

    protected $casts = [
        'user_email_verified_at' => 'datetime',

        'user_package_started_at' => 'datetime',
        'user_promo_until' => 'datetime',
        'user_trial_end_at' => 'datetime',
        'user_expired_at' => 'datetime',

        'user_is_active' => 'boolean',
        'user_is_trial' => 'boolean',
        'user_is_setup_done' => 'boolean',
        'user_is_promo' => 'boolean',
    ];

    public function getAuthPassword()
    {
        return $this->user_password;
    }

    public function getPublicUrlAttribute()
    {
        return url('/' . $this->user_slug);
    }

    public function getIsExpiredAttribute()
    {
        if (!$this->user_expired_at) {
            return false;
        }

        return now()->greaterThan($this->user_expired_at);
    }

    public function getCurrentPriceAttribute()
    {
        if ($this->user_is_promo && $this->user_promo_price) {
            return $this->user_promo_price;
        }

        if ($this->user_package === 'pro') {
            return 99900;
        }

        return 49900;
    }
    public function kategori()
    {
        return $this->hasMany(ModelKategori::class, 'user_id', 'user_id');
    }
    public function products()
    {
        return $this->hasMany(ModelProduct::class, 'user_id', 'user_id');
    }
    public function payments()
    {
        return $this->hasMany(ModelPayment::class, 'user_id', 'user_id');
    }
}
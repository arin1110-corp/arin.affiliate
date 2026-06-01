<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModelLandingSetting;

class LandingSettingSeeder extends Seeder
{
    public function run(): void
    {
        ModelLandingSetting::updateOrCreate(
            ['landing_id' => 1],
            [
                'site_name' => 'ARIN',
                'site_tagline' => 'Affiliate Landing Page Builder',
                'site_description' => 'Bangun toko affiliate pribadi tanpa coding.',
                'hero_title' => 'Buat Website Affiliate Sendiri dalam Hitungan Menit',
                'hero_subtitle' => 'Tampilkan semua produk affiliate Shopee, TikTok, Tokopedia, dan marketplace lainnya dalam satu link yang rapi, profesional, dan siap dibagikan.',
                'cta_text' => 'Daftar Sekarang',
                'cta_link' => '#pricing',
                'whatsapp_number' => '6281234567890',
                'primary_color' => '#ec4899',
                'secondary_color' => '#fdf2f8',
                'accent_color' => '#f43f5e',
                'section_features' => "Tanpa Coding\nMobile Friendly\nCustom Theme\nStatistik Klik\nSEO Dasar\nCocok untuk Shopee Affiliate",
                'section_faq' => "Apakah langsung bisa daftar?|Saat ini pendaftaran dibantu admin terlebih dahulu.\nApakah bisa Shopee Affiliate?|Bisa, tinggal tempel link affiliate produk.\nApakah bisa custom domain?|Bisa untuk paket Pro.",
            ]
        );
    }
}
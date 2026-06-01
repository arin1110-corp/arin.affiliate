<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModelPackage;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        ModelPackage::updateOrCreate(
            ['package_slug' => 'starter'],
            [
                'package_nama' => 'Starter',
                'package_harga_promo' => 14900,
                'package_harga_normal' => 49900,
                'package_masa_aktif' => 30,
                'package_max_product' => 30,
                'package_max_category' => 5,
                'package_custom_domain' => false,
                'package_google_analytics' => false,
                'package_meta_pixel' => false,
                'package_deskripsi' => 'Paket awal untuk affiliate pemula.',
                'package_fitur' => "Subdomain ARIN\nMaksimal 30 produk\nMaksimal 5 kategori\nBanner slider\nStatistik klik dasar\nTheme custom\nSEO dasar",
                'package_is_active' => true,
                'package_sort_order' => 1,
            ]
        );

        ModelPackage::updateOrCreate(
            ['package_slug' => 'pro'],
            [
                'package_nama' => 'Pro',
                'package_harga_promo' => null,
                'package_harga_normal' => 99000,
                'package_masa_aktif' => 30,
                'package_max_product' => null,
                'package_max_category' => null,
                'package_custom_domain' => true,
                'package_google_analytics' => true,
                'package_meta_pixel' => true,
                'package_deskripsi' => 'Paket untuk affiliate yang serius.',
                'package_fitur' => "Produk unlimited\nKategori unlimited\nCustom domain\nGoogle Analytics\nMeta Pixel\nPrioritas support\nBranding penuh",
                'package_is_active' => true,
                'package_sort_order' => 2,
            ]
        );
    }
}
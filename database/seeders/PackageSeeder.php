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
                'package_harga_normal' => 49900,
                'package_harga_promo' => 14900,
                'package_masa_aktif' => 30,

                'package_max_product' => 100,
                'package_max_slider' => 5,
                'package_max_category' => 20,

                'package_custom_domain' => false,
                'package_remove_branding' => false,
                'package_google_analytics' => false,
                'package_meta_pixel' => false,

                'package_deskripsi' => 'Paket awal untuk membuat website affiliate sederhana.',
                'package_fitur' => "Website affiliate siap pakai\nCustom slug\nKategori produk\nProduk affiliate\nSlider\nTracking klik\nSupport basic",

                'package_is_active' => true,
                'package_sort_order' => 1,
            ]
        );

        ModelPackage::updateOrCreate(
            ['package_slug' => 'pro'],
            [
                'package_nama' => 'Pro',
                'package_harga_normal' => 99900,
                'package_harga_promo' => null,
                'package_masa_aktif' => 30,

                'package_max_product' => 1000,
                'package_max_slider' => 20,
                'package_max_category' => 100,

                'package_custom_domain' => true,
                'package_remove_branding' => true,
                'package_google_analytics' => true,
                'package_meta_pixel' => true,

                'package_deskripsi' => 'Paket lanjutan untuk affiliate yang ingin fitur lebih lengkap.',
                'package_fitur' => "Semua fitur Starter\nProduk lebih banyak\nSlider lebih banyak\nCustom domain\nHapus branding ARIN\nGoogle Analytics\nMeta Pixel\nPrioritas support",

                'package_is_active' => true,
                'package_sort_order' => 2,
            ]
        );
    }
}
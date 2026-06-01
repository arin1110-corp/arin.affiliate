<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\ModelUser;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | SUPER ADMIN
        |--------------------------------------------------------------------------
        */

        

        /*
        |--------------------------------------------------------------------------
        | CLIENT DEMO
        |--------------------------------------------------------------------------
        */

        ModelUser::updateOrCreate(
            [
                'user_email' => 'demo@arin.id'
            ],
            [
                'user_nama' => 'Demo User',
                'user_slug' => 'demo-store',

                'user_password' => Hash::make('Demo1234'),

                'user_role' => 'client',
                'user_package' => 'starter',

                'user_brand_name' => 'Demo Store',
                'user_tagline' => 'Produk Affiliate Pilihan',

                'email_verified_at' => now(),

                'user_is_setup_done' => true,
                'user_is_active' => true,

                'user_is_trial' => true,
                'user_trial_end_at' => now()->addDays(3),

                'user_is_promo' => true,
                'user_promo_batch' => 1,
                'user_promo_price' => 14900,

                'user_package_started_at' => now(),
                'user_promo_until' => now()->addMonths(3),

                'user_expired_at' => now()->addMonths(3),

                'user_theme_primary' => '#ec4899',
                'user_theme_secondary' => '#fdf2f8',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | CLIENT PRO
        |--------------------------------------------------------------------------
        */

        ModelUser::updateOrCreate(
            [
                'user_email' => 'pro@arin.id'
            ],
            [
                'user_nama' => 'Pro User',
                'user_slug' => 'pro-store',

                'user_password' => Hash::make('Pro1234'),

                'user_role' => 'client',
                'user_package' => 'pro',

                'user_brand_name' => 'Pro Store',
                'user_tagline' => 'Affiliate Premium',

                'email_verified_at' => now(),

                'user_is_setup_done' => true,
                'user_is_active' => true,

                'user_is_trial' => false,

                'user_package_started_at' => now(),
                'user_expired_at' => now()->addMonth(),

                'user_theme_primary' => '#2563eb',
                'user_theme_secondary' => '#eff6ff',
            ]
        );
    }
}
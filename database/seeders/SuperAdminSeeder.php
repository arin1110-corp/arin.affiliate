<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\ModelUser;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        ModelUser::updateOrCreate(
            [
                'user_email' => 'admin@arinaffiliate.com'
            ],
            [
                'user_nama'       => 'Super Administrator',
                'user_password'   => Hash::make('Admin1234'),
                'user_slug'       => 'superadmin',
                'user_role'       => 'superadmin',
                'user_package'    => 'pro',
                'user_is_active'  => true,
                'user_expired_at' => now()->addYears(10)
            ]
        );
    }
}
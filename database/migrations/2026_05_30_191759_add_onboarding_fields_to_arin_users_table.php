<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('arin_users', function (Blueprint $table) {
            if (!Schema::hasColumn('arin_users', 'email_verified_at')) {
                $table->timestamp('email_verified_at')->nullable()->after('user_email');
            }

            if (!Schema::hasColumn('arin_users', 'user_tagline')) {
                $table->string('user_tagline')->nullable()->after('user_brand_name');
            }

            if (!Schema::hasColumn('arin_users', 'user_description')) {
                $table->text('user_description')->nullable()->after('user_tagline');
            }

            if (!Schema::hasColumn('arin_users', 'user_logo')) {
                $table->string('user_logo')->nullable()->after('user_description');
            }

            if (!Schema::hasColumn('arin_users', 'user_whatsapp')) {
                $table->string('user_whatsapp')->nullable()->after('user_logo');
            }

            if (!Schema::hasColumn('arin_users', 'user_instagram')) {
                $table->string('user_instagram')->nullable()->after('user_whatsapp');
            }

            if (!Schema::hasColumn('arin_users', 'user_tiktok')) {
                $table->string('user_tiktok')->nullable()->after('user_instagram');
            }

            if (!Schema::hasColumn('arin_users', 'user_theme_primary')) {
                $table->string('user_theme_primary')->default('#ec4899')->after('user_tiktok');
            }

            if (!Schema::hasColumn('arin_users', 'user_theme_secondary')) {
                $table->string('user_theme_secondary')->default('#fdf2f8')->after('user_theme_primary');
            }

            if (!Schema::hasColumn('arin_users', 'user_is_setup_done')) {
                $table->boolean('user_is_setup_done')->default(false)->after('user_theme_secondary');
            }

            if (!Schema::hasColumn('arin_users', 'user_package_started_at')) {
                $table->timestamp('user_package_started_at')->nullable()->after('user_package');
            }

            if (!Schema::hasColumn('arin_users', 'user_promo_until')) {
                $table->timestamp('user_promo_until')->nullable()->after('user_package_started_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('arin_users', function (Blueprint $table) {
            $table->dropColumn([
                'email_verified_at',
                'user_tagline',
                'user_description',
                'user_logo',
                'user_whatsapp',
                'user_instagram',
                'user_tiktok',
                'user_theme_primary',
                'user_theme_secondary',
                'user_is_setup_done',
                'user_package_started_at',
                'user_promo_until',
            ]);
        });
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('arin_users', function (Blueprint $table) {

            if (!Schema::hasColumn('arin_users', 'user_favicon')) {
                $table->string('user_favicon')->nullable()->after('user_logo');
            }

            if (!Schema::hasColumn('arin_users', 'user_meta_title')) {
                $table->string('user_meta_title')->nullable()->after('user_tiktok');
            }

            if (!Schema::hasColumn('arin_users', 'user_meta_description')) {
                $table->text('user_meta_description')->nullable()->after('user_meta_title');
            }

            if (!Schema::hasColumn('arin_users', 'user_theme_accent')) {
                $table->string('user_theme_accent')->default('#f43f5e')->after('user_theme_secondary');
            }

            if (!Schema::hasColumn('arin_users', 'user_footer_text')) {
                $table->string('user_footer_text')->nullable()->after('user_theme_accent');
            }

        });
    }

    public function down(): void
    {
        Schema::table('arin_users', function (Blueprint $table) {

            if (Schema::hasColumn('arin_users', 'user_favicon')) {
                $table->dropColumn('user_favicon');
            }

            if (Schema::hasColumn('arin_users', 'user_meta_title')) {
                $table->dropColumn('user_meta_title');
            }

            if (Schema::hasColumn('arin_users', 'user_meta_description')) {
                $table->dropColumn('user_meta_description');
            }

            if (Schema::hasColumn('arin_users', 'user_theme_accent')) {
                $table->dropColumn('user_theme_accent');
            }

            if (Schema::hasColumn('arin_users', 'user_footer_text')) {
                $table->dropColumn('user_footer_text');
            }

        });
    }
};
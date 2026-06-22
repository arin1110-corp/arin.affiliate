<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('arin_packages', function (Blueprint $table) {

            if (!Schema::hasColumn('arin_packages', 'package_max_product')) {
                $table->integer('package_max_product')->default(100)->after('package_promo_duration_days');
            }

            if (!Schema::hasColumn('arin_packages', 'package_max_slider')) {
                $table->integer('package_max_slider')->default(5)->after('package_max_product');
            }

            if (!Schema::hasColumn('arin_packages', 'package_max_category')) {
                $table->integer('package_max_category')->default(20)->after('package_max_slider');
            }

            if (!Schema::hasColumn('arin_packages', 'package_custom_domain')) {
                $table->boolean('package_custom_domain')->default(false)->after('package_max_category');
            }

            if (!Schema::hasColumn('arin_packages', 'package_remove_branding')) {
                $table->boolean('package_remove_branding')->default(false)->after('package_custom_domain');
            }
        });
    }

    public function down(): void
    {
        Schema::table('arin_packages', function (Blueprint $table) {
            if (Schema::hasColumn('arin_packages', 'package_remove_branding')) {
                $table->dropColumn('package_remove_branding');
            }

            if (Schema::hasColumn('arin_packages', 'package_custom_domain')) {
                $table->dropColumn('package_custom_domain');
            }

            if (Schema::hasColumn('arin_packages', 'package_max_category')) {
                $table->dropColumn('package_max_category');
            }

            if (Schema::hasColumn('arin_packages', 'package_max_slider')) {
                $table->dropColumn('package_max_slider');
            }

            if (Schema::hasColumn('arin_packages', 'package_max_product')) {
                $table->dropColumn('package_max_product');
            }
        });
    }
};
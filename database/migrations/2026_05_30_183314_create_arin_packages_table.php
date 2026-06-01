<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arin_packages', function (Blueprint $table) {
            $table->id('package_id');

            $table->string('package_nama');
            $table->string('package_slug')->unique();

            $table->decimal('package_harga_promo', 12, 0)->nullable();
            $table->decimal('package_harga_normal', 12, 0);

            $table->integer('package_masa_aktif')->default(30);
            $table->integer('package_max_product')->nullable();
            $table->integer('package_max_category')->nullable();

            $table->boolean('package_custom_domain')->default(false);
            $table->boolean('package_google_analytics')->default(false);
            $table->boolean('package_meta_pixel')->default(false);

            $table->text('package_deskripsi')->nullable();
            $table->text('package_fitur')->nullable();

            $table->boolean('package_is_active')->default(true);
            $table->integer('package_sort_order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arin_packages');
    }
};
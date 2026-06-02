<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arin_products', function (Blueprint $table) {
            $table->id('product_id');

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_kategori')->nullable();

            $table->string('product_nama');
            $table->string('product_slug');

            $table->string('product_thumbnail')->nullable();

            $table->decimal('product_harga', 15, 0)->nullable();

            $table->text('product_deskripsi')->nullable();

            $table->longText('product_affiliate_link');

            $table->integer('product_total_click')->default(0);

            $table->boolean('product_featured')->default(false);

            $table->enum('product_status', ['draft', 'active'])->default('active');

            $table->timestamps();
            $table->softDeletes();

            $table->index('user_id');
            $table->index('product_kategori');
            $table->unique(['user_id', 'product_slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arin_products');
    }
};
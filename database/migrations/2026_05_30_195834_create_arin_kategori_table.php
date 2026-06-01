<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arin_kategori', function (Blueprint $table) {
            $table->id('kategori_id');

            $table->unsignedBigInteger('user_id');

            $table->string('kategori_nama');
            $table->string('kategori_slug');
            $table->text('kategori_deskripsi')->nullable();
            $table->string('kategori_thumbnail')->nullable();

            $table->string('kategori_meta_title')->nullable();
            $table->text('kategori_meta_description')->nullable();

            $table->boolean('kategori_is_active')->default(true);
            $table->boolean('kategori_is_visible')->default(true);
            $table->integer('kategori_sort_order')->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->index('user_id');
            $table->unique(['user_id', 'kategori_slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arin_kategori');
    }
};
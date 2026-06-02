<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arin_sliders', function (Blueprint $table) {

            $table->id('slider_id');

            $table->unsignedBigInteger('user_id');

            $table->string('slider_judul')->nullable();

            $table->text('slider_deskripsi')->nullable();

            $table->string('slider_image')->nullable();

            $table->string('slider_button_text')->nullable();

            $table->string('slider_button_link')->nullable();

            $table->integer('slider_sort_order')->default(0);

            $table->boolean('slider_is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arin_sliders');
    }
};
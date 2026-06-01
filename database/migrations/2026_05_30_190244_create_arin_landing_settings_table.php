<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arin_landing_settings', function (Blueprint $table) {
            $table->id('landing_id');

            $table->string('site_name')->default('ARIN');
            $table->string('site_tagline')->nullable();
            $table->text('site_description')->nullable();

            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->string('hero_image')->nullable();

            $table->string('cta_text')->nullable();
            $table->string('cta_link')->nullable();

            $table->string('whatsapp_number')->nullable();

            $table->string('primary_color')->default('#ec4899');
            $table->string('secondary_color')->default('#fdf2f8');
            $table->string('accent_color')->default('#f43f5e');

            $table->text('section_features')->nullable();
            $table->text('section_faq')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arin_landing_settings');
    }
};
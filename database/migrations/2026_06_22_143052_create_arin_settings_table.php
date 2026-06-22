<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arin_settings', function (Blueprint $table) {

            $table->id('setting_id');

            $table->string('app_name')->nullable();
            $table->string('app_logo')->nullable();
            $table->string('app_favicon')->nullable();

            $table->string('support_email')->nullable();
            $table->string('support_whatsapp')->nullable();

            $table->string('footer_text')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arin_settings');
    }
};
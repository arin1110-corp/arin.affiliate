<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('arin_sliders', function (Blueprint $table) {

            if (!Schema::hasColumn('arin_sliders', 'slider_subjudul')) {
                $table->text('slider_subjudul')->nullable()->after('slider_judul');
            }

            if (!Schema::hasColumn('arin_sliders', 'slider_image_mobile')) {
                $table->string('slider_image_mobile')->nullable()->after('slider_image');
            }

        });
    }

    public function down(): void
    {
        Schema::table('arin_sliders', function (Blueprint $table) {

            $table->dropColumn([
                'slider_subjudul',
                'slider_image_mobile'
            ]);

        });
    }
};
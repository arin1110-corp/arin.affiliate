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

            if (!Schema::hasColumn('arin_sliders', 'slider_link')) {
                $table->string('slider_link')->nullable()->after('slider_image_mobile');
            }

            if (!Schema::hasColumn('arin_sliders', 'deleted_at')) {
                $table->softDeletes();
            }

        });
    }

    public function down(): void
    {
        Schema::table('arin_sliders', function (Blueprint $table) {

            if (Schema::hasColumn('arin_sliders', 'slider_subjudul')) {
                $table->dropColumn('slider_subjudul');
            }

            if (Schema::hasColumn('arin_sliders', 'slider_image_mobile')) {
                $table->dropColumn('slider_image_mobile');
            }

            if (Schema::hasColumn('arin_sliders', 'slider_link')) {
                $table->dropColumn('slider_link');
            }

            if (Schema::hasColumn('arin_sliders', 'deleted_at')) {
                $table->dropSoftDeletes();
            }

        });
    }
};
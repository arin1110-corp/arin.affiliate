<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::table('arin_packages', function (Blueprint $table) {
            $table->integer('package_max_product')->default(100);

            $table->integer('package_max_slider')->default(5);

            $table->integer('package_max_category')->default(20);

            $table->boolean('package_custom_domain')->default(false);

            $table->boolean('package_remove_branding')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
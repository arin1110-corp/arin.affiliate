<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('arin_products', function (Blueprint $table) {

            $table->text('product_link_shopee')->nullable()->after('product_affiliate_link');
            $table->text('product_link_tokopedia')->nullable();
            $table->text('product_link_lazada')->nullable();
            $table->text('product_link_tiktok')->nullable();
            $table->text('product_link_blibli')->nullable();
            $table->text('product_link_bukalapak')->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('arin_products', function (Blueprint $table) {

            $table->dropColumn([
                'product_link_shopee',
                'product_link_tokopedia',
                'product_link_lazada',
                'product_link_tiktok',
                'product_link_blibli',
                'product_link_bukalapak'
            ]);

        });
    }
};
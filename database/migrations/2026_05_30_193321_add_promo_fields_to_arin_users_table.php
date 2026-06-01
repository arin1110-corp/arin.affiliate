<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('arin_users', function (Blueprint $table) {

            if (!Schema::hasColumn('arin_users', 'user_is_promo')) {
                $table->boolean('user_is_promo')
                    ->default(false)
                    ->after('user_package');
            }

            if (!Schema::hasColumn('arin_users', 'user_promo_batch')) {
                $table->integer('user_promo_batch')
                    ->nullable()
                    ->after('user_is_promo');
            }

            if (!Schema::hasColumn('arin_users', 'user_promo_price')) {
                $table->decimal('user_promo_price', 12, 0)
                    ->nullable()
                    ->after('user_promo_batch');
            }

        });
    }

    public function down(): void
    {
        Schema::table('arin_users', function (Blueprint $table) {

            if (Schema::hasColumn('arin_users', 'user_is_promo')) {
                $table->dropColumn('user_is_promo');
            }

            if (Schema::hasColumn('arin_users', 'user_promo_batch')) {
                $table->dropColumn('user_promo_batch');
            }

            if (Schema::hasColumn('arin_users', 'user_promo_price')) {
                $table->dropColumn('user_promo_price');
            }

        });
    }
};
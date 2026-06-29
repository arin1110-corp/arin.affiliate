<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('arin_users', function (Blueprint $table) {
            $table->string('user_payment_status')
                ->default('unpaid')
                ->after('user_is_active');

            $table->timestamp('user_last_payment_at')
                ->nullable()
                ->after('user_payment_status');

            $table->timestamp('user_next_billing_at')
                ->nullable()
                ->after('user_last_payment_at');

            $table->string('user_invoice_number')
                ->nullable()
                ->after('user_next_billing_at');
        });
    }

    public function down(): void
    {
        Schema::table('arin_users', function (Blueprint $table) {
            $table->dropColumn([
                'user_payment_status',
                'user_last_payment_at',
                'user_next_billing_at',
                'user_invoice_number',
            ]);
        });
    }
};
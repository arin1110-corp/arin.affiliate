<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('arin_payments', function (Blueprint $table) {
            if (!Schema::hasColumn('arin_payments', 'midtrans_order_id')) {
                $table->string('midtrans_order_id')->nullable()->after('payment_invoice')->unique();
            }

            if (!Schema::hasColumn('arin_payments', 'midtrans_transaction_id')) {
                $table->string('midtrans_transaction_id')->nullable()->after('midtrans_order_id');
            }

            if (!Schema::hasColumn('arin_payments', 'midtrans_payment_type')) {
                $table->string('midtrans_payment_type')->nullable()->after('midtrans_transaction_id');
            }

            if (!Schema::hasColumn('arin_payments', 'midtrans_transaction_status')) {
                $table->string('midtrans_transaction_status')->nullable()->after('midtrans_payment_type');
            }

            if (!Schema::hasColumn('arin_payments', 'midtrans_fraud_status')) {
                $table->string('midtrans_fraud_status')->nullable()->after('midtrans_transaction_status');
            }

            if (!Schema::hasColumn('arin_payments', 'midtrans_snap_token')) {
                $table->string('midtrans_snap_token')->nullable()->after('midtrans_fraud_status');
            }

            if (!Schema::hasColumn('arin_payments', 'midtrans_redirect_url')) {
                $table->text('midtrans_redirect_url')->nullable()->after('midtrans_snap_token');
            }

            if (!Schema::hasColumn('arin_payments', 'expired_at')) {
                $table->timestamp('expired_at')->nullable()->after('approved_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('arin_payments', function (Blueprint $table) {
            if (Schema::hasColumn('arin_payments', 'midtrans_order_id')) {
                $table->dropColumn('midtrans_order_id');
            }

            if (Schema::hasColumn('arin_payments', 'midtrans_transaction_id')) {
                $table->dropColumn('midtrans_transaction_id');
            }

            if (Schema::hasColumn('arin_payments', 'midtrans_payment_type')) {
                $table->dropColumn('midtrans_payment_type');
            }

            if (Schema::hasColumn('arin_payments', 'midtrans_transaction_status')) {
                $table->dropColumn('midtrans_transaction_status');
            }

            if (Schema::hasColumn('arin_payments', 'midtrans_fraud_status')) {
                $table->dropColumn('midtrans_fraud_status');
            }

            if (Schema::hasColumn('arin_payments', 'midtrans_snap_token')) {
                $table->dropColumn('midtrans_snap_token');
            }

            if (Schema::hasColumn('arin_payments', 'midtrans_redirect_url')) {
                $table->dropColumn('midtrans_redirect_url');
            }

            if (Schema::hasColumn('arin_payments', 'expired_at')) {
                $table->dropColumn('expired_at');
            }
        });
    }
};
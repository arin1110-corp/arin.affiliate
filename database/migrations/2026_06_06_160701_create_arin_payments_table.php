<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arin_payments', function (Blueprint $table) {
            $table->id('payment_id');

            $table->unsignedBigInteger('user_id');

            $table->string('payment_invoice')->unique();
            $table->string('payment_package');
            $table->decimal('payment_amount', 15, 0);

            $table->string('payment_method')->nullable();
            $table->string('payment_proof')->nullable();

            $table->enum('payment_status', [
                'waiting_confirmation',
                'approved',
                'rejected',
            ])->default('waiting_confirmation');

            $table->text('payment_note')->nullable();

            $table->timestamp('paid_at')->nullable();
            $table->timestamp('approved_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arin_payments');
    }
};
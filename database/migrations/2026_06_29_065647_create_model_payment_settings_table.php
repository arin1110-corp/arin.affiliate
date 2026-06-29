<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arin_payment_settings', function (Blueprint $table) {

            $table->id('setting_id');

            /*
            |--------------------------------------------------------------------------
            | Gateway
            |--------------------------------------------------------------------------
            */

            $table->enum(
                'payment_gateway',
                [
                    'manual',
                    'midtrans'
                ]
            )->default('manual');

            /*
            |--------------------------------------------------------------------------
            | Manual Payment
            |--------------------------------------------------------------------------
            */

            $table->string('payment_qris_image')
                ->nullable();

            $table->string('payment_bank_name')
                ->nullable();

            $table->string('payment_bank_number')
                ->nullable();

            $table->string('payment_bank_holder')
                ->nullable();

            $table->string('payment_bank_name_2')
                ->nullable();

            $table->string('payment_bank_number_2')
                ->nullable();

            $table->string('payment_bank_holder_2')
                ->nullable();

            $table->string('payment_bank_name_3')
                ->nullable();

            $table->string('payment_bank_number_3')
                ->nullable();

            $table->string('payment_bank_holder_3')
                ->nullable();

            $table->string('payment_whatsapp')
                ->nullable();

            $table->text('payment_note')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Midtrans
            |--------------------------------------------------------------------------
            */

            $table->string('midtrans_server_key')
                ->nullable();

            $table->string('midtrans_client_key')
                ->nullable();

            $table->boolean('midtrans_is_production')
                ->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'arin_payment_settings'
        );
    }
};
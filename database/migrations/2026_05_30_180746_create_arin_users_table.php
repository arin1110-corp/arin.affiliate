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
        Schema::create('arin_users', function (Blueprint $table) {
            $table->id('user_id');

            $table->string('user_nama');
            $table->string('user_email')->unique();
            $table->string('user_password');

            $table->string('user_slug')->unique();

            $table->enum('user_role', ['superadmin', 'client'])->default('client');
            $table->enum('user_package', ['starter', 'pro'])->default('starter');

            $table->timestamp('user_expired_at')->nullable();
            $table->boolean('user_is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arin_users');
    }
};
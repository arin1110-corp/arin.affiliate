<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('arin_users', function (Blueprint $table) {
            $table->string('user_brand_name')->nullable()->after('user_slug');
            $table->string('user_domain')->nullable()->after('user_brand_name');
            $table->string('user_subdomain')->nullable()->after('user_domain');

            $table->boolean('user_is_trial')->default(true)->after('user_package');
            $table->timestamp('user_trial_end_at')->nullable()->after('user_is_trial');
        });
    }

    public function down(): void
    {
        Schema::table('arin_users', function (Blueprint $table) {
            $table->dropColumn([
                'user_brand_name',
                'user_domain',
                'user_subdomain',
                'user_is_trial',
                'user_trial_end_at',
            ]);
        });
    }
};
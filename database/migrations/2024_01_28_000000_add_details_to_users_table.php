<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user')->after('password');
            $table->string('status')->default('pending')->after('role');
            $table->string('phone_number')->nullable()->after('status');
            $table->string('religion_id')->nullable()->after('phone_number'); // Storing ID or Name, nullable
            $table->string('province_id')->nullable()->after('religion_id');
            $table->string('regency_id')->nullable()->after('province_id');
            $table->string('district_id')->nullable()->after('regency_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'status', 'phone_number', 'religion_id', 'province_id', 'regency_id', 'district_id']);
        });
    }
};

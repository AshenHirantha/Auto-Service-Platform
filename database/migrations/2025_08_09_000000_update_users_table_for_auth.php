<?php

// database/migrations/2024_01_01_000000_update_users_table_for_auth.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Add missing authentication fields
            //$table->timestamp('email_verified_at')->nullable()->after('email');
            
            $table->timestamp('phone_verified_at')->nullable()->after('password');
            $table->boolean('is_active')->default(true)->after('phone_verified_at');
            $table->enum('user_type', ['customer', 'service_station', 'vendor', 'admin'])
                  ->default('customer')->after('is_active');
           
            
        });

        // Update ServiceStation table to link with users
        Schema::table('service_stations', function (Blueprint $table) {
            $table->foreignId('owner_id')->nullable()->after('id')
                  ->constrained('users')->onDelete('cascade');
        });

        // Update PartsVendor table to link with users
        Schema::table('parts_vendors', function (Blueprint $table) {
            $table->foreignId('owner_id')->nullable()->after('id')
                  ->constrained('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'email_verified_at',
                'password',
                'phone_verified_at',
                'is_active',
                'user_type',
                'remember_token',
                'updated_at'
            ]);
        });

        Schema::table('service_stations', function (Blueprint $table) {
            $table->dropForeign(['owner_id']);
            $table->dropColumn('owner_id');
        });

        Schema::table('parts_vendors', function (Blueprint $table) {
            $table->dropForeign(['owner_id']);
            $table->dropColumn('owner_id');
        });
    }
};

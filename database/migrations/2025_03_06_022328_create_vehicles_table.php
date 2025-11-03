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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('registration_number', 50)->unique();
            $table->string('make', 50);
            $table->string('model', 50);
            $table->integer('year');
            $table->string('chassis_number', 50)->nullable();
            $table->string('fuel_type', 20)->nullable();
            $table->string('transmission_type', 20)->nullable();
            $table->date('purchase_date')->nullable();
            $table->integer('mileage')->nullable();
            $table->string('status', 20)->default('active');
            $table->timestamps();

            // Add indexes for frequently accessed fields
            $table->index('user_id');
            $table->index(['make', 'model', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
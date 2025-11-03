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
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('type', 50); // 'Service', 'Order', 'Consultation', etc.
            $table->unsignedBigInteger('reference_id');
            $table->decimal('amount', 10, 2);
            $table->string('status', 20)->default('pending');
            $table->dateTime('transaction_date');
            $table->string('payment_method', 50);
            $table->timestamps();
            
            // Add indexes for performance
            $table->index(['type', 'reference_id']);
            $table->index(['status', 'transaction_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_transactions');
    }
};
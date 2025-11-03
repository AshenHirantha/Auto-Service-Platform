<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('inventory_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_id')->constrained()->onDelete('cascade');
            $table->enum('transaction_type', ['IN', 'OUT', 'ADJUST']);
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2)->nullable();
            $table->string('reference_type', 20)->nullable();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->text('reason')->nullable();
            $table->string('authorized_by', 100)->nullable();
            $table->dateTime('transaction_date');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index('inventory_id');
            $table->index('transaction_type');
            $table->index('transaction_date');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory_transactions');
    }
};
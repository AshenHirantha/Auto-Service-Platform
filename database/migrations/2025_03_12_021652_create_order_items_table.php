<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('parts_orders')->onDelete('cascade');
            $table->foreignId('part_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('subtotal', 10, 2);
            $table->string('status', 20)->default('pending');
            $table->dateTime('estimated_delivery')->nullable();
            $table->dateTime('actual_delivery')->nullable();
            $table->string('serial_number', 50)->nullable();
            $table->string('batch_number', 50)->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_warranty_applied')->default(false);
            $table->dateTime('warranty_start_date')->nullable();
            $table->dateTime('warranty_end_date')->nullable();
            $table->boolean('quality_checked')->default(false);
            $table->string('quality_status', 20)->nullable();
            $table->text('return_reason')->nullable();
            $table->boolean('is_cancelled')->default(false);
            $table->dateTime('cancelled_at')->nullable();
            $table->text('cancellation_reason')->nullable();
            $table->timestamps();
            
            $table->index('order_id');
            $table->index('part_id');
            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};

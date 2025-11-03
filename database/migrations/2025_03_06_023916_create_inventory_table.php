<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->constrained('service_stations')->onDelete('cascade');
            $table->enum('item_type', ['Part', 'Tool', 'Consumable']);
            $table->unsignedBigInteger('item_id');
            $table->string('item_name', 100);
            $table->string('SKU', 50)->nullable();
            $table->string('barcode', 50)->nullable();
            $table->integer('current_stock')->default(0);
            $table->integer('minimum_stock')->default(0);
            $table->integer('reorder_point')->default(0);
            $table->integer('maximum_stock')->nullable();
            $table->decimal('unit_cost', 10, 2)->nullable();
            $table->decimal('selling_price', 10, 2)->nullable();
            $table->string('storage_location', 50)->nullable();
            $table->string('condition', 20)->nullable();
            $table->dateTime('expiry_date')->nullable();
            $table->string('batch_number', 50)->nullable();
            $table->string('quality_status', 20)->nullable();
            $table->dateTime('last_stock_check')->nullable();
            $table->timestamps();
            
            $table->index('location_id');
            $table->index(['item_type', 'item_id']);
            $table->index('SKU');
            $table->index(['current_stock', 'minimum_stock', 'reorder_point']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('supplier_inventory', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('parts_vendors')->onDelete('cascade');
            $table->unsignedBigInteger('item_id');
            $table->decimal('supplier_price', 10, 2);
            $table->integer('lead_time')->nullable();
            $table->integer('minimum_order_quantity')->default(1);
            $table->string('supplier_SKU', 50)->nullable();
            $table->float('bulk_discount_threshold')->nullable();
            $table->float('bulk_discount_percent')->nullable();
            $table->boolean('is_preferred_supplier')->default(false);
            $table->text('contract_terms')->nullable();
            $table->date('contract_expiry')->nullable();
            $table->timestamps();
            
            $table->index('supplier_id');
            $table->index('item_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('supplier_inventory');
    }
};
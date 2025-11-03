<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('parts_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('vendor_id')->constrained('parts_vendors');
            $table->dateTime('order_date');
            $table->decimal('total_amount', 10, 2);
            $table->string('status', 20)->default('pending');
            $table->text('shipping_address');
            $table->string('tracking_info', 100)->nullable();
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('vendor_id');
            $table->index(['status', 'order_date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('parts_orders');
    }
};
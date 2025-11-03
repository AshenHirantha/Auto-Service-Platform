<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('return_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_item_id')->constrained()->onDelete('cascade');
            $table->dateTime('request_date');
            $table->text('reason');
            $table->string('condition', 20);
            $table->string('status', 20)->default('pending');
            $table->text('resolution')->nullable();
            $table->decimal('refund_amount', 10, 2)->nullable();
            $table->string('return_shipping_label', 255)->nullable();
            $table->dateTime('processed_date')->nullable();
            $table->timestamps();
            
            $table->index('order_item_id');
            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('return_requests');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('order_item_status', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_item_id')->constrained()->onDelete('cascade');
            $table->string('status', 20);
            $table->text('description')->nullable();
            $table->dateTime('timestamp');
            $table->string('updated_by', 100)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index('order_item_id');
            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_item_status');
    }
};
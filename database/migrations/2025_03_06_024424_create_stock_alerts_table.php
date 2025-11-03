<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stock_alerts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_id')->constrained()->onDelete('cascade');
            $table->enum('alert_type', ['Low', 'Reorder', 'Excess']);
            $table->string('status', 20);
            $table->dateTime('generated_at');
            $table->dateTime('resolved_at')->nullable();
            $table->text('resolution')->nullable();
            $table->timestamps();
            
            $table->index('inventory_id');
            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('stock_alerts');
    }
};
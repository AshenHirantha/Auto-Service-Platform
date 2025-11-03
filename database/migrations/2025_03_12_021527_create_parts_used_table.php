<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('parts_used', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_history_id')->constrained()->onDelete('cascade');
            $table->foreignId('part_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->string('part_condition', 20)->nullable();
            $table->string('warranty_period', 50)->nullable();
            $table->text('replacement_reason')->nullable();
            $table->dateTime('installed_at')->nullable();
            $table->timestamps();
            
            $table->index('service_history_id');
            $table->index('part_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('parts_used');
    }
};
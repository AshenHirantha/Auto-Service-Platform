<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $table->foreignId('station_id')->constrained('service_stations');
            $table->dateTime('request_date');
            $table->string('status', 20)->default('pending');
            $table->text('description')->nullable();
            $table->decimal('estimated_cost', 10, 2)->nullable();
            $table->decimal('final_cost', 10, 2)->nullable();
            $table->dateTime('completion_date')->nullable();
            $table->timestamps();
            
            $table->index('vehicle_id');
            $table->index('station_id');
            $table->index('status');
            $table->index(['status', 'request_date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_requests');
    }
};
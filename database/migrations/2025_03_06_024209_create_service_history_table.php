<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('service_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_request_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_station_id')->constrained('service_stations');
            $table->foreignId('mechanic_id')->nullable()->constrained('staff')->nullOnDelete();
            $table->dateTime('service_date');
            $table->integer('mileage_at_service')->nullable();
            $table->string('service_type', 50);
            $table->text('diagnosis')->nullable();
            $table->text('recommendations')->nullable();
            $table->decimal('labor_cost', 10, 2)->nullable();
            $table->decimal('parts_cost', 10, 2)->nullable();
            $table->decimal('total_cost', 10, 2)->nullable();
            $table->string('quality_check', 20)->nullable();
            $table->text('warranty_info')->nullable();
            $table->dateTime('next_service_due')->nullable();
            $table->string('status', 20);
            $table->timestamps();
            
            $table->index('vehicle_id');
            $table->index('service_request_id');
            $table->index(['vehicle_id', 'service_date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_history');
    }
};
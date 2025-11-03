<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('station_id')->constrained('service_stations')->onDelete('cascade');
            $table->string('name', 100);
            $table->string('role', 50);
            $table->string('specialization', 100)->nullable();
            $table->string('schedule', 255)->nullable();
            $table->float('rating')->nullable();
            $table->timestamps();
            
            $table->index('station_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('staff');
    }
};

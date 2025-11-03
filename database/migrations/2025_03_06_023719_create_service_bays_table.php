<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('service_bays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('station_id')->constrained('service_stations')->onDelete('cascade');
            $table->string('name', 50);
            $table->string('type', 50);
            $table->string('status', 20)->default('available');
            $table->string('current_service', 100)->nullable();
            $table->timestamps();
            
            $table->index('station_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_bays');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $table->string('type', 50);
            $table->string('file_url', 255);
            $table->date('expiry_date')->nullable();
            $table->date('upload_date');
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
            
            $table->index('vehicle_id');
            $table->index('type');
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
};
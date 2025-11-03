<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('service_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_history_id')->constrained()->onDelete('cascade');
            $table->enum('image_type', ['Before', 'After', 'Issue']);
            $table->string('image_url', 255);
            $table->text('description')->nullable();
            $table->dateTime('captured_at')->nullable();
            $table->timestamps();
            
            $table->index('service_history_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_images');
    }
};


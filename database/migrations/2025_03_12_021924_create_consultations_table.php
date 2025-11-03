<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('expert_id')->constrained()->onDelete('cascade');
            $table->dateTime('schedule_time');
            $table->string('status', 20)->default('scheduled');
            $table->text('problem')->nullable();
            $table->text('diagnosis')->nullable();
            $table->decimal('cost', 10, 2)->nullable();
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('expert_id');
            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('consultations');
    }
};

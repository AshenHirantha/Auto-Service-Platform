<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('insurance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $table->string('provider', 100);
            $table->string('policy_number', 50);
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('premium', 10, 2)->nullable();
            $table->text('coverage')->nullable();
            $table->timestamps();
            
            $table->index('vehicle_id');
            $table->index(['provider', 'policy_number']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('insurance');
    }
};
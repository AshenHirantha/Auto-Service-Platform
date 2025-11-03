<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('warranties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_history_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('part_id')->nullable()->constrained()->nullOnDelete();
            $table->string('warranty_type', 50);
            $table->date('start_date');
            $table->date('end_date');
            $table->text('terms')->nullable();
            $table->text('coverage')->nullable();
            $table->string('status', 20)->default('active');
            $table->timestamps();
            
            $table->index('service_history_id');
            $table->index('part_id');
            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('warranties');
    }
};
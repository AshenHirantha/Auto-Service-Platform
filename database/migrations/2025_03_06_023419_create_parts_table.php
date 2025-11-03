<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('category', 50);
            $table->string('manufacturer', 100)->nullable();
            $table->text('model_compatibility')->nullable();
            $table->text('specifications')->nullable();
            $table->boolean('is_genuine')->default(false);
            $table->string('warranty', 100)->nullable();
            $table->timestamps();
            
            $table->index(['category', 'manufacturer']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('parts');
    }
};


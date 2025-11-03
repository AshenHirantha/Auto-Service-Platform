<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('parts_vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('location', 255);
            $table->string('contact', 100);
            $table->string('tax_info', 100)->nullable();
            $table->float('rating')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->string('business_hours', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('parts_vendors');
    }
};

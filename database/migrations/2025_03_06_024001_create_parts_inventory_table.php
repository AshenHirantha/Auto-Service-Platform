<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('parts_inventory', function (Blueprint $table) {
            $table->id();
            $table->foreignId('part_id')->constrained()->onDelete('cascade');
            $table->foreignId('vendor_id')->constrained('parts_vendors')->onDelete('cascade');
            $table->integer('quantity')->default(0);
            $table->decimal('price', 10, 2);
            $table->string('condition', 20);
            $table->string('availability', 20);
            $table->timestamps();
            
            $table->index(['part_id', 'vendor_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('parts_inventory');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_item_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->timestamps();
        });

        // Seed common statuses
        DB::table('order_item_statuses')->insert([
            ['name' => 'Pending', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Processing', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Shipped', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Delivered', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cancelled', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('order_item_statuses');
    }
};


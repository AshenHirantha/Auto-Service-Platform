<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('parts_inventory') && ! Schema::hasTable('parts_inventories')) {
            Schema::rename('parts_inventory', 'parts_inventories');
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('parts_inventories') && ! Schema::hasTable('parts_inventory')) {
            Schema::rename('parts_inventories', 'parts_inventory');
        }
    }
};


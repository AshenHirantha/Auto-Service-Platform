<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            if (!Schema::hasColumn('order_items', 'status_id')) {
                $table->foreignId('status_id')->nullable()->constrained('order_item_statuses');
                $table->index('status_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            if (Schema::hasColumn('order_items', 'status_id')) {
                $table->dropConstrainedForeignId('status_id');
            }
        });
    }
};


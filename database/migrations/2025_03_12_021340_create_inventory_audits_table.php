<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('inventory_audits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_id')->constrained()->onDelete('cascade');
            $table->dateTime('audit_date');
            $table->integer('system_quantity');
            $table->integer('actual_quantity');
            $table->integer('discrepancy')->nullable();
            $table->text('reason')->nullable();
            $table->decimal('value_impact', 10, 2)->nullable();
            $table->string('conducted_by', 100);
            $table->string('status', 20);
            $table->text('resolution')->nullable();
            $table->dateTime('resolved_at')->nullable();
            $table->timestamps();
            
            $table->index('inventory_id');
            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory_audits');
    }
};
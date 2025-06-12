<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // This is the pivot table for the Many-to-Many relationship between Menu and Order
        Schema::create('menu_order', function (Blueprint $table) {
            // Foreign Keys that also serve as a composite Primary Key
            $table->foreignId('menu_id')->constrained('menu', 'menu_id')->cascadeOnDelete();
            $table->foreignId('order_id')->constrained('order', 'order_id')->cascadeOnDelete();
            
            // Additional attribute on the pivot table
            $table->integer('kuantitas'); // PDM: Menu_Order_Kuantitas

            // Define the composite primary key
            $table->primary(['menu_id', 'order_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_order');
    }
};
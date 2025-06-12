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
        // Corresponds to the 'Menu' table in your PDM
        Schema::create('menu', function (Blueprint $table) {
            $table->id('menu_id'); // PDM: Menu_ID (PK)
            $table->string('menu_nama'); // PDM: Menu_Nama
            $table->integer('menu_harga'); // PDM: Menu_Harga
            $table->integer('menu_stok'); // PDM: Menu_Stok
            $table->string('menu_gambar')->nullable(); // PDM: Menu_Gambar
            $table->string('menu_kategori'); // PDM: Menu_Kategori
            
            // Foreign Key for Toko: A 'Menu' item belongs to a 'Toko'.
            $table->foreignId('toko_id')->constrained('toko', 'toko_id')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
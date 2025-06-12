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
        // Corresponds to the 'Toko' table in your PDM
        Schema::create('toko', function (Blueprint $table) {
            $table->id('toko_id'); // PDM: Toko_ID (PK)
            $table->string('toko_nama'); // PDM: Toko_Nama
            $table->string('toko_no_rekening'); // PDM: Toko_NoRekening
            $table->string('toko_gambar')->nullable(); // PDM: Toko_Gambar
            
            // Foreign Key for Admin: A 'Toko' belongs to an 'Admin'.
            $table->foreignId('admin_id')->constrained('admin', 'admin_id')->cascadeOnDelete();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('toko');
    }
};
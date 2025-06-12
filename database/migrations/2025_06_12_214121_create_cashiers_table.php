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
        // Corresponds to the 'Cashier' table in your PDM
        Schema::create('cashier', function (Blueprint $table) {
            $table->id('cashier_id'); // PDM: Cashier_ID (PK)
            $table->string('cashier_nama'); // PDM: Cashier_Nama
            $table->string('cashier_email')->unique(); // PDM: Cashier_Email
            $table->string('cashier_no_telp'); // PDM: Cashier_NoTelp
            $table->string('cashier_password'); // PDM: Cashier_Passwor (corrected typo)

            // Foreign Key for Toko: A 'Cashier' belongs to/works at a 'Toko'.
            // This is a more standard interpretation of your PDM's relationship lines.
            $table->foreignId('toko_id')->constrained('toko', 'toko_id')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cashier');
    }
};
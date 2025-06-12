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
        // Corresponds to the 'Customer' table in your PDM
        Schema::create('customer', function (Blueprint $table) {
            $table->id('customer_id'); // PDM: Customer_ID (PK)
            $table->string('customer_nama'); // PDM: Customer_Nama
            $table->string('customer_email')->unique(); // PDM: Customer_Email
            $table->string('customer_no_telp', 15); // PDM: Customer_NoTelp
            $table->string('customer_password'); // PDM: Customer_Passw (corrected typo)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
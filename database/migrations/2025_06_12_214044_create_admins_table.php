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
        // Corresponds to the 'Admin' table in your PDM
        Schema::create('admin', function (Blueprint $table) {
            $table->id('admin_id'); // PDM: Admin_ID (PK)
            $table->string('admin_nama', 20); // PDM: Admin_Nama
            $table->string('admin_email', 255)->unique(); // PDM: Admin_Email
            $table->string('admin_password'); // PDM: Admin_Password
            $table->timestamps(); // Standard Laravel practice
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
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
        // Corresponds to the 'Order' table in your PDM
        Schema::create('order', function (Blueprint $table) {
            $table->id('order_id'); // PDM: Order_ID (PK)
            $table->timestamp('order_tanggal')->useCurrent(); // PDM: Order_Tanggal
            $table->string('order_total_harga', 20); // PDM: Order_TotalHarga
            $table->string('order_status_pesanan', 50); // PDM: Order_StatusPesana (Typo corrected)
            $table->integer('order_no_meja'); // PDM: Order_NoMeja
            $table->boolean('order_status_pembayaran')->default(false); // PDM: Order_StatusPembay (Typo corrected)
            
            // Foreign Keys
            $table->foreignId('customer_id')->constrained('customer', 'customer_id');
            $table->foreignId('toko_id')->constrained('toko', 'toko_id');
            $table->foreignId('cashier_id')->nullable()->constrained('cashier', 'cashier_id');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};

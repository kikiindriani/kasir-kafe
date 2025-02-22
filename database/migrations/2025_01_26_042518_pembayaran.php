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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran', 11)->unsigned()->autoIncrement();
            $table->foreignId('id_pemesanan')->constrained('pemesanan', 'id_pemesanan')->onDelete('cascade');
            $table->foreignId('id_pegawai')->constrained('pegawai', 'id_pegawai')->onDelete('cascade');
            $table->date('tanggal_pembayaran');
            $table->enum('metode_pembayaran', ['Cash', 'Cashless']);
            $table->integer('total_pembayaran');
            $table->enum('status', ['Sudah Dibayar', 'Belum Dibayar']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};

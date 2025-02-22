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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id('id_pemesanan', 11)->unsigned()->autoIncrement();
            $table->integer('jumlah');
            $table->integer('total_harga');
            $table->date('tanggal_pemesanan');
            $table->integer('nomor_meja');
            $table->foreignId('id_member')->constrained('member', 'id_member')->onDelete('cascade');
            $table->enum('diskon', ['true', 'false'])->default('false');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};

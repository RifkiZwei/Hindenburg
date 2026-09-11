<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi_buku', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('member')->restrictOnDelete();
            $table->foreignId('buku_id')->constrained('buku')->restrictOnDelete();
            $table->enum('jenis', ['pinjam', 'beli']);
            $table->unsignedInteger('jumlah')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_buku');
    }
};

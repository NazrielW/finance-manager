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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel users (user yang membuat transaksi)
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // Relasi ke tabel categories (kategori transaksi)
            $table->foreignId('category_id')
                ->constrained('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('title');

            // Jenis transaksi: pemasukan / pengeluaran
            $table->enum('type', ['income', 'expense']);

            // Jumlah uang
            $table->decimal('amount', 15, 2);

            // Keterangan tambahan (boleh kosong)
            $table->string('description')->nullable();

            // Sumber uang (misalnya: gaji, tabungan, hadiah, dll)
            $table->string('source')->nullable();

            // Tanggal transaksi
            $table->date('date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

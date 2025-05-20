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
        Schema::create('estimasi_biayas', function (Blueprint $table) {
            $table->string('id_estimasi')->primary();
            $table->string('nama');
            $table->string('no_polis');
            $table->string('tipe_mobil');
            $table->integer('km_aktual');
            $table->date('tanggal_transaksi');
            $table->decimal('total_jasa', 15, 2);
            $table->decimal('total_barang', 15, 2);
            $table->decimal('total_biaya', 15, 2);
            $table->string('id_user');
            $table->timestamps();
            
            // Adding foreign key relationship to users table
            $table->foreign('id_user')->references('id_user')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estimasi_biayas');
    }
};
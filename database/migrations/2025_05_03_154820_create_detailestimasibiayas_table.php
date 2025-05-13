<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_estimasi_biayas', function (Blueprint $table) {
            $table->string('id_detail_estimasi')->primary();
            $table->string('id_estimasi');
            $table->string('nama');
            $table->string('detail_type');
            $table->decimal('harga_satuan', 15, 2);
            $table->integer('qty');
            $table->decimal('discount', 15, 2);
            $table->decimal('jumlah', 15, 2);
            $table->string('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('id_estimasi')->references('id_estimasi')->on('estimasi_biayas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_estimasi_biayas');
    }
};

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
        Schema::create('parts', function (Blueprint $table) {
            $table->string('id_part')->primary();
            $table->string('nama_part');
            $table->string('tipe_mobil');
            $table->string('no_part');
            $table->string('no_part_eff');
            $table->string('no_part_carb');
            $table->decimal('harga_part_eff', 15, 2);
            $table->decimal('harga_part_carb', 15, 2);
            $table->integer('stock_plan');
            $table->integer('stock_actual');
            $table->integer('selisih');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parts');
    }
};

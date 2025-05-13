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
        Schema::create('jasa_berkalas', function (Blueprint $table) {
            $table->string('id_jasa')->primary();
            $table->string('tipe_mobil');
            $table->string('jenis_service');
            $table->decimal('biaya_jasa', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jasa_berkalas');
    }
};

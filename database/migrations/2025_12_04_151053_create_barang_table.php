<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->string('kode_barang', 255)->primary();
            $table->string('nama_barang', 255);
            $table->string('satuan', 50);
            $table->integer('jumlah')->default(0);

            $table->unsignedInteger('id_kategori');
            $table->foreign('id_kategori')
                ->references('id_kategori')->on('kategori')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};

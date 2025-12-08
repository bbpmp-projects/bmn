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
        Schema::create('detail_permintaan', function (Blueprint $table) {
            $table->increments('id_detail_permintaan');
            $table->integer('jumlah');
            $table->unsignedInteger('kode_permintaan');
            $table->string('kode_barang', 20);
            $table->foreign('kode_permintaan')
                ->references('kode_permintaan')->on('permintaan')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('kode_barang')
                ->references('kode_barang')->on('barang')
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
        Schema::dropIfExists('detail_permintaan');
    }
};

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
        Schema::create('permintaan', function (Blueprint $table) {
            $table->increments('kode_permintaan');
            
            $table->unsignedBigInteger('id_users');
            $table->foreign('id_users')
                ->references('id')->on('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->date('tanggal');
            $table->string('total_barang', 255);
            $table->string('status', 100);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan');
    }
};

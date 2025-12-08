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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');  
            $table->string('username', 100)->unique();
            $table->string('email', 255)->unique();
            $table->string('nama_lengkap', 255);
            $table->string('unit_kerja', 255)->nullable();
            $table->string('nip', 50)->nullable();
            $table->string('password', 255);

            $table->timestamps(); // <-- created_at & updated_at otomatis
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

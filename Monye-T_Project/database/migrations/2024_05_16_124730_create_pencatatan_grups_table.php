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
        Schema::create('pencatatan_grups', function (Blueprint $table) {
            $table->bigIncrements('pencatatan_grup_id');
            $table->bigInteger('grups_id');
            $table->bigInteger('users_id');
            $table->bigInteger('kategori_grups_id');
            $table->bigInteger('jumlah');
            $table->string('deskripsi');
            $table->string('bukti');
            $table->string('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pencatatan_grups');
    }
};

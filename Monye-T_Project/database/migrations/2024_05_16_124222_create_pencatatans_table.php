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
        Schema::create('pencatatans', function (Blueprint $table) {
            $table->bigIncrements('pencatatan_id');
            $table->bigInteger('users_id');
            $table->bigInteger('kategori_id');
            $table->bigInteger('kantung_id');
            $table->string('status');
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
        Schema::dropIfExists('pencatatans');
    }
};

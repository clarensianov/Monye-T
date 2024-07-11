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
            $table->bigInteger('kategoris_id');
            $table->bigInteger('dompets_id');
            $table->string('status');
            $table->bigInteger('jumlah');
            $table->string('deskripsi')->nullable();
            $table->string('bukti')->nullable();
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

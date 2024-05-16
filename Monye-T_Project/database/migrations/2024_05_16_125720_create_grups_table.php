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
        Schema::create('grups', function (Blueprint $table) {
            $table->bigIncrements('grup_id');
            $table->string('kode_grup')->unique();
            $table->string('nama_grup');
            $table->string('deskripsi_grup');
            $table->bigInteger('budget_grup');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grups');
    }
};

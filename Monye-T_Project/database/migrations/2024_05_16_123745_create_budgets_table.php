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
        Schema::create('budgets', function (Blueprint $table) {
            $table->bigIncrements('budget_id');
            $table->bigInteger('users_id');
            $table->bigInteger('kategoris_id');
            $table->string('nama_budget');
            $table->bigInteger('jumlah');
            $table->string('tanggal_pembuatan');
            $table->string('tanggal_berakhir');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};

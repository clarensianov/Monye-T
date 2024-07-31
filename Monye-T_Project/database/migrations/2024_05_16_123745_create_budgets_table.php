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
            $table->bigInteger('kategoris_id')->nullable();
            $table->string('nama_budget')->nullable();
            $table->bigInteger('jumlah')->nullable();
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

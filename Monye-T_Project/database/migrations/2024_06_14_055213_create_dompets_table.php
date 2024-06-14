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
        Schema::dropIfExists('kantungs');

        Schema::create('dompets', function (Blueprint $table) {
            $table->bigIncrements('dompet_id');
            $table->bigInteger('user_id');
            $table->string('nama_dompet');
            $table->bigInteger('jumlah_uang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dompets');
    }
};

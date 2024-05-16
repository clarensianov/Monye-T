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
        Schema::create('grup_users', function (Blueprint $table) {
            $table->bigIncrements('grup_user_id');
            $table->bigInteger('grups_id');
            $table->bigInteger('users_id');
            $table->bigInteger('budget_user');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grup_users');
    }
};

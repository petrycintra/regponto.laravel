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
        Schema::create('registros', function (Blueprint $table) {
            $table->string('name');
            $table->date('data');
            $table->dateTime('entrada');
            $table->dateTime('intervalo')->nullable();
            $table->dateTime('volta')->nullable();
            $table->dateTime('final')->nullable();
            $table->integer('controle');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros');
    }
};

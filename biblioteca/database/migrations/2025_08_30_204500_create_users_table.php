<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('cpf', 15)->primary();
            $table->string('nome', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('senha', 255)->nullable();
            $table->string('role', 20)->nullable();
            $table->string('telefone', 50)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
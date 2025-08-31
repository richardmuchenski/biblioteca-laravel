<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->string('isbn', 50)->primary();
            $table->string('titulo', 50)->nullable();
            $table->string('autor', 50)->nullable();
            $table->year('ano_publicado')->nullable();
            $table->string('categoria', 50)->nullable();
            $table->integer('quantidade_estoque')->nullable();
            $table->string('capa_url', 200)->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable()->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
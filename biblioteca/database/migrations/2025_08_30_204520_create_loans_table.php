<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->date('loan_date');
            $table->date('return_date')->nullable();
            $table->boolean('returned')->default(0);
            $table->string('user_cpf', 15);
            $table->string('book_isbn', 50);
            $table->foreign('user_cpf')->references('cpf')->on('users')->onDelete('cascade');
            $table->foreign('book_isbn')->references('isbn')->on('books')->onDelete('cascade');
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable()->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
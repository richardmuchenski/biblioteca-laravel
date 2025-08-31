<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\UserController;

// A rota principal  vai para a tela de login (se não estiver logado)
Route::get('/', function () {
    // Se o usuário já estiver logado, vai para /books. Senão, vai para /login.
    return redirect()->route('books.index');
})->middleware(['auth']); // O middleware 'auth' força o login

// Este grupo de rotas SÓ PODE SER ACESSADO por usuários autenticados.
Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('books', BookController::class);
    Route::resource('loans', LoanController::class);
});

// Inclui as rotas geradas pelo Breeze (/login, /register, /logout, etc.)
require __DIR__.'/auth.php';
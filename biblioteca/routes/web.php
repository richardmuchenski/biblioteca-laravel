<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\UserController;

// USERS
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');

// BOOKS
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::post('/books', [BookController::class, 'store'])->name('books.store');

// LOANS
Route::get('/loans/create', [LoanController::class, 'create'])->name('loans.create');
Route::post('/loans', [LoanController::class, 'store'])->name('loans.store');
Route::get('/loans/{id}', [LoanController::class, 'show'])->name('loans.show');
Route::put('/loans/{id}', [LoanController::class, 'update'])->name('loans.update');
Route::delete('/loans/{id}', [LoanController::class, 'destroy'])->name('loans.destroy');

// Rota inicial (página inicial)
Route::get('/', function () {
    return view('welcome');
});
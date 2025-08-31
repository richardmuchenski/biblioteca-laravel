<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\UserController;
use App\Htpp\Controllers\ProfileController;


// Rota para a página de boas-vindas ou redirecionamento inicial
Route::get('/', function () {
    // Se o usuário não estiver logado, ele será automaticamente enviado para 'login', se estiver logado, será enviado para o seu respectivo painel
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('dashboard');
    }
    return view('welcome'); // Mostra a página 'welcome' para visitantes
});

// Rota users.
Route::middleware(['auth'])->group(function () {
    
    // Rota para o painel do usuário comum
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rotas de Empréstimo para o usuário comum
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/loans/create', [LoanController::class, 'create'])->name('loans.create');
    Route::post('/loans', [LoanController::class, 'store'])->name('loans.store');
    Route::patch('/loans/{loan}/return', [LoanController::class, 'returnBook'])->name('loans.return');

    //Rotas administrativas
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Rotas para gerenciar Livros e Usuários
        // Nota: as URLs serão /admin/books, /admin/users, etc.
        Route::resource('books', BookController::class)->except(['show']); // Excluímos a rota 'show' se não for usada
        Route::resource('users', UserController::class)->except(['show']);

    });
});

// Inclui as rotas de autenticação (login, registro, logout, etc.)
require __DIR__.'/auth.php';
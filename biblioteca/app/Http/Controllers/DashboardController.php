<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importa a facade de Autenticação
use Illuminate\View\View;

class DashboardController extends Controller
{
    
    public function index(): View
    {
        // Pega o usuário que está atualmente logado
        $user = Auth::user();

        // Carrega os empréstimos associados a este usuário,
        // e para cada empréstimo, também carrega os dados do livro relacionado.
        $loans = $user->loans()->with('book')->get();

        // Retorna a view do dashboard, passando os empréstimos para ela
        return view('dashboard', ['loans' => $loans]);
    }
}
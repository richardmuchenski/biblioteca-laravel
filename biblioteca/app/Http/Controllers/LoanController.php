<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    /**
     * Mostra a página com livros disponíveis para empréstimo.
     */
    public function create()
    {
        // Busca apenas os livros que têm mais de 0 unidades no estoque
        $availableBooks = Book::where('quantidade_estoque', '>', 0)->get();
        
        return view('loans.create', ['books' => $availableBooks]);
    }

    /**
     * Registra um novo empréstimo no banco de dados.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_isbn' => ['required', 'string', 'exists:books,isbn'],
        ]);

        $book = Book::find($request->book_isbn);

        // Verificação extra para garantir que o livro ainda está disponível
        if ($book->quantidade_estoque < 1) {
            return back()->with('error', 'Desculpe, este livro não está mais disponível no estoque.');
        }

        // Cria o registro do empréstimo
        Loan::create([
            'user_cpf' => Auth::user()->cpf, // Pega o CPF do usuário logado
            'book_isbn' => $request->book_isbn,
            'loan_date' => now(), // Define a data do empréstimo como a data/hora atual
            'returned' => false,
        ]);

        // Diminui 1 unidade do estoque do livro
        $book->decrement('quantidade_estoque');

        return redirect()->route('dashboard')->with('success', 'Livro emprestado com sucesso!');
    }

    public function returnBook(Loan $loan)
    {
        // Verifica se o empréstimo pertence ao usuário logado
        if ($loan->user_cpf !== Auth::user()->cpf) {
            return back()->with('error', 'Você não tem permissão para devolver este livro.');
        }

        // Verifica se o livro já foi devolvido
        if ($loan->returned) {
            return back()->with('error', 'Este livro já foi devolvido.');
        }

        // Marca o empréstimo como devolvido
        $loan->returned = true;
        $loan->return_date = now(); // Define a data de devolução como a data/hora atual
        $loan->save();

        // Aumenta 1 unidade no estoque do livro
        $book = Book::find($loan->book_isbn);
        $book->increment('quantidade_estoque');

        return redirect()->route('dashboard')->with('success', 'Livro devolvido com sucesso!');
    }   
}
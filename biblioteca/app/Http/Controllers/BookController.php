<?php
namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('books.index', ['books' => $books]);
    }

    public function create()
    {
        return view('books.create');
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:50',
            'autor' => 'required|string|max:50',
            'ano_publicado' => 'required|integer', 
            'categoria' => 'required|string|max:50',
            'quantidade_estoque' => 'required|integer|min:0', 
            'capa_url' => 'nullable|string|max:200',
            'isbn' => 'required|string|max:50|unique:books,isbn',
            'last_used_at' => 'nullable|date',
            'expires_at' => 'nullable|date',
            'created_at' => 'nullable|date',
            'updated_at' => 'nullable|date',
        ]);

        Book::create($validatedData);

        // Redireciona para a página de listagem
        return redirect()->route('books.index')->with('success', 'Livro cadastrado com sucesso!');
    }
    
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', ['book' => $book]);
    }
    
    public function update(Request $request, $id) {
        $book = Book::findOrFail($id);

        $validatedData = $request->validate([
            'titulo' => 'required|string|max:50',
            'autor' => 'required|string|max:50',
            'ano_publicado' => 'required|integer', 
            'categoria' => 'required|string|max:50',
            'quantidade_estoque' => 'required|integer|min:0', 
            'capa_url' => 'nullable|string|max:200',
        ]);

        $book->update($validatedData);

        return redirect()->route('books.index')->with('success', 'Livro atualizado com sucesso!');
    }

    public function destroy($id) {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Livro deletado com sucesso!');
    }
    // Os outros métodos (show, update, destroy) podem ser mantidos ou ajustados depois
}
<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function create()
{
    return view('books.create'); // books
}
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'editora' => 'required|string|max:255',
            'ano_publicacao' => 'required|integer|min:0',
            'isbn' => 'required|string|size:13|unique:books',
            'categoria' => 'required|string|max:100',
            'quantidade_disponivel' => 'required|integer|min:0'
        ]);

        $book = Book::create($validatedData);

        return response()->json($book, 201);
    }

    public function show($isbn)
    {
        $book = Book::find($isbn);

        if (!$book) {
            return response()->json(['message' => 'Livro não encontrado'], 404);
        }

        return response()->json($book);
    }

    public function update(Request $request, $isbn)
    {
        $book = Book::find($isbn);

        if (!$book) {
            return response()->json(['message' => 'Livro não encontrado'], 404);
        }

        $validatedData = $request->validate([
            'titulo' => 'sometimes|required|string|max:255',
            'autor' => 'sometimes|required|string|max:255',
            'editora' => 'sometimes|required|string|max:255',
            'ano_publicacao' => 'sometimes|required|integer|min:0',
            'categoria' => 'sometimes|required|string|max:100',
            'quantidade_disponivel' => 'sometimes|required|integer|min:0'
        ]);

        $book = Book::create($validated);
        return response()->json($book, 201);
    }
    public function destroy($isbn)
    {
        $book = Book::find($isbn);

        if (!$book) {
            return response()->json(['message' => 'Livro não encontrado'], 404);
        }

        $book->delete();

        return response()->json(['message' => 'Livro deletado com sucesso']);
    }
}

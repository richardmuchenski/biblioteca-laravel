<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function create()
{
    return view('loans.create'); // loans
}
    public function store(Request $request)
    {
        $validated = $request->validate([
            'loan_date' => 'required|date',
            'return_date' => 'nullable|date',
            'user_cpf' => 'required|string|exists:users,cpf',
            'book_ISBN' => 'required|string|exists:books,isbn',
        ]);

        $loan = Loan::create($validated);
        return response()->json($loan, 201);
    }

    public function show($id)
    {
        $loan = Loan::with(['user', 'book'])->findOrFail($id);
        return response()->json($loan);
    }

    public function update(Request $request, $id)
    {
        $loan = Loan::find($id);
        
        if (!$loan) {
            return response()->json(['message' => 'Empréstimo não encontrado'], 404);
        }
        $validatedData = $request->validate([
            'loan_date' => 'sometimes|required|date',
            'return_date' => 'sometimes|nullable|date',
            'returned' => 'sometimes|required|boolean',
            'user_cpf' => 'sometimes|required|string|exists:users,cpf',
            'book_ISBN' => 'sometimes|required|string|exists:books,isbn',
        ]);

        $loan->update($validatedData);

        return response()->json($loan);
    }

    public function destroy($id)
    {
        $loan = Loan::find($id);

        if (!$loan) {
            return response()->json(['message' => 'Empréstimo não encontrado'], 404);
        }

        $loan->delete();
        return response()->json(['message' => 'Empréstimo deletado com sucesso']);
    }
}
<?php
namespace App\Http\Controllers;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    
    public function index()
    {
        $loans = Loan::paginate(15); // Para um sistema real, use paginação: Loan::paginate(15);
        return view('loans.index', ['loans' => $loans]);
    }
    
    public function create()
    {
        return view('loans.create');
    }

    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'loan_date' => 'required|date',
            'return_date' => 'nullable|date',
            'user_cpf' => 'required|string|exists:users,cpf',
            'book_isbn' => 'required|string|exists:books,isbn', 
        ]);

        Loan::create($validated);

        // Redirecionando a página de listagem de empréstimos com mensagem de sucesso
        return redirect()->route('loans.index')->with('success', 'Empréstimo registrado com sucesso!');
    }

    public function show($id)
    {
        $loan = Loan::findOrFail($id);
        return view('loans.show', ['loan' => $loan]);
    }

    public function edit($id) {
        $loan = Loan::findOrFail($id);
        return view('loans.edit', ['loan' => $loan]);
    }

    public function update(Request $request, $id) {
        $loan = Loan::findOrFail($id);

        $validated = $request->validate([
            'loan_date' => 'required|date',
            'return_date' => 'nullable|date',
            'user_cpf' => 'required|string|exists:users,cpf',
            'book_isbn' => 'required|string|exists:books,isbn', 
            'returned' => 'required|boolean',
        ]);

        $loan->update($validated);

        return redirect()->route('loans.index')->with('success', 'Empréstimo atualizado com sucesso!');
    }

    public function destroy($id) {
        $loan = Loan::findOrFail($id);
        $loan->delete();
        return redirect()->route('loans.index')->with('success', 'Empréstimo deletado com sucesso!');
    }   
    // Os outros métodos (show, update, destroy) podem ser mantidos ou ajustados depois
}
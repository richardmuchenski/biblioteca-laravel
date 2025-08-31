<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function index()
    {
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        //Método store.
        \Log::info('POST /users/create', $request->all());
        try {
            $validated = $request->validate([
                'cpf' => 'required|string|max:15|unique:users,cpf',
                'nome' => 'nullable|string|max:100',
                'email' => 'nullable|email|max:100|unique:users,email',
                'senha' => 'nullable|string|max:255',
                'role' => 'nullable|string|max:20',
                'telefone' => 'nullable|string|max:50',
            ]);
            if (!empty($validated['senha'])) {
                $validated['senha'] = Hash::make($validated['senha']);
            } else {
                unset($validated['senha']); // Remove a senha se estiver vazia
            }
            User::create($validated);
            \Log::info('User created: cpf=' . $validated['cpf']);
            return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
        } catch (\Exception $e) {
            \Log::error('Error creating user: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Falha ao criar usuário: ' . $e->getMessage()]);
        }
    }
}
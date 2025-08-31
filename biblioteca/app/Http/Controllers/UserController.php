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
                'name' => 'nullable|string|max:100',
                'email' => 'nullable|email|max:100|unique:users,email',
                'password' => 'nullable|string|max:255',
                'role' => 'nullable|string|max:20',
                'telefone' => 'nullable|string|max:50',
            ]);
            if (!empty($validated['password'])) {
                $validated['password'] = Hash::make($validated['password']);
            } else {
                unset($validated['password']); // Remove a password se estiver vazia
            }
            User::create($validated);
            \Log::info('User created: cpf=' . $validated['cpf']);
            return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
        } catch (\Exception $e) {
            \Log::error('Error creating user: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Falha ao criar usuário: ' . $e->getMessage()]);
        }
    }

    public function edit($cpf)
    {
        $user = User::findOrFail($cpf);
        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, $cpf)
    {
        //Método para atualizar usuário.
        \Log::info('PUT /users/' . $cpf, $request->all());
        try {
            $user = User::findOrFail($cpf);
            $validated = $request->validate([
                'name' => 'nullable|string|max:100',
                'email' => 'nullable|email|max:100|unique:users,email,' . $cpf . ',cpf',
                'password' => 'nullable|string|max:255',
                'role' => 'nullable|string|max:20',
                'telefone' => 'nullable|string|max:50',
            ]);
            if (!empty($validated['password'])) {
                $validated['password'] = Hash::make($validated['password']);
            } else {
                unset($validated['password']); // Remove a password se estiver vazia
            }
            $user->update($validated);
            \Log::info('User updated: cpf=' . $cpf);
            return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
        } catch (\Exception $e) {
            \Log::error('Error updating user: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Falha ao atualizar usuário: ' . $e->getMessage()]);
        }
    }

    public function destroy($cpf)
    {
        //Método para deletar usuário.
        \Log::info('DELETE /users/' . $cpf);
        try {
            $user = User::findOrFail($cpf);
            $user->delete();
            \Log::info('User deleted: cpf=' . $cpf);
            return redirect()->route('users.index')->with('success', 'Usuário deletado com sucesso!');
        } catch (\Exception $e) {
            \Log::error('Error deleting user: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Falha ao deletar usuário: ' . $e->getMessage()]);
        }
    }
}
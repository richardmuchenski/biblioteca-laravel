<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function create()
{
    return view('users.create'); // users
}
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'senha' => 'required|string|min:6',
            'telefone' => 'nullable|string|max:15',
            'cpf' => 'required|string|size:11|unique:users',
            'role' => 'required|string|in:admin,user'
        ]);

        $user = User::create($validatedData);

        return response()->json($user, 201);
    }

    public function show($cpf)
    {
        $user = User::find($cpf);

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        return response()->json($user);
    }

    public function update(Request $request, $cpf)
    {
        $user = User::find($cpf);

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        $validatedData = $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $cpf . ',cpf',
            'senha' => 'sometimes|required|string|min:6',
            'telefone' => 'nullable|string|max:15',
            'role' => 'sometimes|required|string|in:admin,user'
        ]);

        $user->update($validatedData);

        return response()->json($user);
    }

    public function destroy($cpf)
    {
        $user = User::find($cpf);

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Usuário deletado com sucesso']);
    }
}
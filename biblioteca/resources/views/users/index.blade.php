<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gerenciar Usuários') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h3">Lista de Usuários</h1>
                        <a href="{{ route('users.create') }}" class="btn btn-primary">Cadastrar Novo Usuário</a>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">CPF</th>
                                <th> </th>
                                <th scope="col">Nome</th>
                                <th> </th>
                                <th scope="col">Email</th>
                                <th> </th>
                                <th scope="col">Telefone</th>
                                <th> </th>
                                <th scope="col">Cargo (Role)</th>
                                <th> </th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->cpf }}</th>
                                    <th> </th>
                                    <td>{{ $user->name }}</td>
                                    <th> </th>
                                    <td>{{ $user->email }}</td>
                                    <th> </th>
                                    <th scope="row">{{ $user->telefone }}</th>
                                    <th> </th>
                                    <td>{{ $user->role ?? 'Usuário' }}</td>
                                    <td>
                                        <a href="{{ route('users.edit', $user->cpf) }}" class="btn btn-sm btn-warning">Editar</a>
                                        <form action="{{ route('users.destroy', $user->cpf) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Nenhum usuário encontrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @endpush
</x-app-layout>
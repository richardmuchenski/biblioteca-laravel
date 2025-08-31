<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Usuário') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('users.update', $user->cpf) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Campos do formulário --}}
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome:</label>
                            <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $user->nome) }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}">
                        </div>
                        <div class="mb-3">
                            <label for="telefone" class="form-label">Telefone:</label>
                            <input type="text" name="telefone" id="telefone" class="form-control" value="{{ old('telefone', $user->telefone) }}">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Cargo (ex: admin):</label>
                            <input type="text" name="role" id="role" class="form-control" value="{{ old('role', $user->role) }}">
                        </div>

                        <button type="submit" class="btn btn-success">Atualizar Usuário</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @endpush
</x-app-layout>
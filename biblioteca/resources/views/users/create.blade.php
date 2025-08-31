<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Lista de Usuários</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary">Cadastrar Novo Usuário</a>
    </div>

    {{-- Exibição de mensagem de sucesso --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">CPF</th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Telefone</th>
                <th scope="col">Senha</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            {{-- O Controller precisa enviar uma variável $users com os dados --}}
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->cpf }}</th>
                    <td>{{ $user->nome }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->telefone }}</td>
                    <td>{{ $user->senha }}</td>
                    <td>
                        {{-- Botões para editar e deletar (funcionalidades futuras) --}}
                        <a href="#" class="btn btn-sm btn-warning">Editar</a>
                        <a href="#" class="btn btn-sm btn-danger">Excluir</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
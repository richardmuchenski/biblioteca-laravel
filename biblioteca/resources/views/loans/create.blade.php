<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Registro de Empréstimos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Registro de Empréstimos</h1>
        <a href="{{ route('loans.create') }}" class="btn btn-primary">Registrar Novo Empréstimo</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Usuário (CPF)</th>
                <th scope="col">Livro (ISBN)</th>
                <th scope="col">Data do Empréstimo</th>
                <th scope="col">Status</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            {{-- O Controller precisa enviar uma variável $loans com os dados --}}
            @foreach ($loans as $loan)
                <tr>
                    <th scope="row">{{ $loan->id }}</th>
                    <td>{{ $loan->user_cpf }}</td>
                    <td>{{ $loan->book_isbn }}</td>
                    <td>{{ \Carbon\Carbon::parse($loan->loan_date)->format('d/m/Y') }}</td>
                    <td>
                        @if($loan->returned)
                            <span class="badge bg-success">Devolvido</span>
                        @else
                            <span class="badge bg-warning text-dark">Emprestado</span>
                        @endif
                    </td>
                    <td>
                        {{-- Aqui poderia ter um botão para registrar a devolução --}}
                        @if(!$loan->returned)
                            <a href="#" class="btn btn-sm btn-info">Devolver</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
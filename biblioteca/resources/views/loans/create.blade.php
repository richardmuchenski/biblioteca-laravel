<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Registrar Empréstimo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h1>Registrar Empréstimo</h1>

    <form action="{{ route('loans.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>CPF do Usuário:</label>
            <input type="text" name="user_cpf" class="form-control">
        </div>
        <div class="mb-3">
            <label>ISBN do Livro:</label>
            <input type="text" name="book_ISBN" class="form-control">
        </div>
        <div class="mb-3">
            <label>Data do Empréstimo:</label>
            <input type="date" name="loan_date" class="form-control">
        </div>
        <div class="mb-3">
            <label>Data de Devolução:</label>
            <input type="date" name="return_date" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>

</body>
</html>

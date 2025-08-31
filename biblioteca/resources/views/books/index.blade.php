<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Acervo de Livros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Acervo de Livros</h1>
        <a href="{{ route('books.create') }}" class="btn btn-primary">Cadastrar Novo Livro</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">ISBN</th>
                <th scope="col">Título</th>
                <th scope="col">Autor</th>
                <th scope="col">Estoque</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            {{-- O Controller precisa enviar uma variável $books com os dados --}}
            @foreach ($books as $book)
                <tr>
                    <th scope="row">{{ $book->isbn }}</th>
                    <td>{{ $book->titulo }}</td>
                    <td>{{ $book->autor }}</td>
                    <td>{{ $book->quantidade_estoque }}</td>
                    <td>
                         <a href="{{ route('books.edit', $book->isbn) }}" class="btn btn-sm btn-warning">Editar</a>

                        <form action="{{ route('books.destroy', $book->isbn) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este livro?')">
                                Excluir
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
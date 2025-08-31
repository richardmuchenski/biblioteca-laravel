<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Livro: {{ $book->titulo  }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Editar Livro: {{ $book->titulo  }}</h1>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Voltar para a Lista</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ops!</strong> Houve alguns problemas com os dados inseridos.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.update', $book->isbn) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="isbn" class="form-label">ISBN:</label>
            <input type="text" name="isbn" id="isbn" class="form-control" value="{{ old('isbn', $book->isbn) }}">
        </div>
        <div class="mb-3">
            <label for="titulo" class="form-label">Título:</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="{{ old('titulo', $book->titulo) }}">
        </div>
        <div class="mb-3">
            <label for="autor" class="form-label">Autor:</label>
            <input type="text" name="autor" id="autor" class="form-control" value="{{ old('autor', $book->autor) }}">
        </div>
        <div class="mb-3">
            <label for="ano_publicado" class="form-label">Ano Publicado:</label>
            <input type="number" name="ano_publicado" id="ano_publicado" class="form-control" value="{{ old('ano_publicado', $book->ano_publicado) }}">
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoria:</label>
            <input type="text" name="categoria" id="categoria" class="form-control" value="{{ old('categoria', $book->categoria) }}">
        </div>
        <div class="mb-3">
            <label for="quantidade_estoque" class="form-label">Quantidade em Estoque:</label>
            <input type="number" name="quantidade_estoque" id="quantidade_estoque" class="form-control" value="{{ old('quantidade_estoque', $book->quantidade_estoque) }}">
        </div>
        <div class="mb-3">
            <label for="capa_url" class="form-label">URL da Capa:</label>
            <input type="text" name="capa_url" id="capa_url" class="form-control" value="{{ old('capa_url', $book->capa_url ) }}">
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Livro</button>
    </form>

</body>
</html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Livro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h1>Cadastrar Livro</h1>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>ISBN:</label>
            <input type="text" name="isbn" class="form-control">
        </div>
        <div class="mb-3">
            <label>Título:</label>
            <input type="text" name="titulo" class="form-control">
        </div>
        <div class="mb-3">
            <label>Autor:</label>
            <input type="text" name="autor" class="form-control">
        </div>
        <div class="mb-3">
            <label>Ano Publicado:</label>
            <input type="number" name="ano_publicado" class="form-control">
        </div>
        <div class="mb-3">
            <label>Categoria:</label>
            <input type="text" name="categoria" class="form-control">
        </div>
        <div class="mb-3">
            <label>Quantidade em Estoque:</label>
            <input type="number" name="quantidade_estoque" class="form-control">
        </div>
        <div class="mb-3">
            <label>URL da Capa:</label>
            <input type="text" name="capa_url" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>

</body>
</html>

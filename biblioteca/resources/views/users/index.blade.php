






<td>
    <a href="{{ route('users.edit', $user->cpf) }}" class="btn btn-sm btn-warning">Editar</a>
    <form action="{{ route('users.destroy', $user->cpf) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</button>
    </form>
</td>
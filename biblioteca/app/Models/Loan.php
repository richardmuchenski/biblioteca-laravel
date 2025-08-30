<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_cpf',
        'book_isbn',
        'data_emprestimo',
        'data_devolucao',
        'status'
    ];

    // Relação com Usuário
    public function user()
    {
        return $this->belongsTo(User::class, 'user_cpf', 'cpf');
    }

    // Relação com Livro
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_isbn', 'isbn');
    }

    public function create()
{
    return view('loans.create'); // loans
}

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $primaryKey = 'isbn'; // Define isbn como chave primária
    protected $keyType = 'string'; // Define o tipo da chave primária como string
    public $incrementing = false; // Indica que a chave primária não é auto-incrementável

    protected $fillable = [
        'titulo',
        'autor',
        'ano_publicado',
        'isbn',
        'categoria',
        'quantidade_estoque',
        'capa_url'
    ];

    // Relação com Empréstimos
    public function loans()
    {
        return $this->hasMany(Loan::class, 'book_isbn', 'isbn');
    }

}

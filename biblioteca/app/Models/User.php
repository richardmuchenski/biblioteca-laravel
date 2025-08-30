<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    
    use HasFactory;

    protected $primaryKey = 'cpf'; // Define cpf como chave primária
    protected $keyType = 'string'; // Define o tipo da chave primária como string
    public $incrementing = false; // Indica que a chave primária não é auto-incrementável

    protected $fillable = [
        'nome',
        'email',
        'senha',
        'telefone',
        'cpf',
        'role'        
    ];


    //Relação com Empréstimos
    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class, 'user_cpf', 'cpf');
    }

    public function create()
{
    return view('users.create'); // users
}

}


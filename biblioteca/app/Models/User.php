<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
Use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'cpf';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = ['cpf', 'nome', 'email', 'senha', 'role', 'telefone'];

    protected $hidden = [
        'senha',
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class, 'user_cpf', 'cpf');
    }

}
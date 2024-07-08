<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'cpf', 'nome', 'sobrenome', 'data_nascimento', 'email', 'genero',
    ];
}

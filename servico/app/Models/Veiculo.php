<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    protected $fillable = [
        'modelo',
        'fabricante',
        'ano_fabricacao',
        'valor',
        'placa',
        'uf'
    ];
}

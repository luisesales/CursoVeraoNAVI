<?php

namespace App\Models;
use App\Veiculo;
use Illuminate\Database\Eloquent\Model;

class Promocao extends Model
{
    protected $fillable = [
        'descricao',
        'imagem',
        'veiculo_id'
    ];

    /**
    * @return BelongsTo
    */
    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }
}

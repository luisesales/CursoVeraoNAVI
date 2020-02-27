<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vendedor;
use App\Models\Cliente;
use App\Models\Veiculo;

class Venda extends Model
{
    protected $fillable = [
        'vendedor_id',
        'veiculo_id',
        'cliente_id'
    ];
    /**
     * @return BelongsTo
     */
    public function vendedor()
    {
        return $this->belongsTo(Vendedor::class);
    }
    /**
     * @return BelongsTo
     */
    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }
    /**
     * @return BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}


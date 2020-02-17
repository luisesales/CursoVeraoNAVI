<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Venda;

class Vendedor extends Model
{
    protected $table = 'vendedores';
    protected $fillable = [
        'name',
        'cpf',
        'email',
        'password',
        'phone',
        'address',
    ];
    /**
     * @return HasMany
     */
    public function venda()
    {
        return $this->hasMany(Venda::class);
    }
}

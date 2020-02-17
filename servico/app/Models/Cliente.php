<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Venda;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Cliente extends Model
{
    protected $fillable = [
        'name',
        'cpf',
        'email',
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

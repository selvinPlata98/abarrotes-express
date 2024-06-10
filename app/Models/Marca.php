<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class, 'marca_id');
    }
}

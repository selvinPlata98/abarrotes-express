<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Marca extends Model
{


use HasFactory;

protected $table = 'marcas';

    protected $fillable = [
        'nombre',
        'enlace',
        'imagen',
        'descripcion',
        'disponible'
    ];

    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class, 'marca_id');
    }

    public function cupones()
    {
        return $this->hasMany(Cupon::class, 'marca_id');
    }


}

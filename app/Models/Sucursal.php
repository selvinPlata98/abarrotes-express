<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sucursal extends Model
{
    use HasFactory;

    protected $table = 'sucursales';

    protected $fillable = [
        'nro_sucursal',
        'departamento',
        'direccion_completa',
        'ciudad',
        'municipio',
        'en_operacion'
    ];


    public function direcciones(): HasMany
    {
        return $this->hasMany(Direccion::class, 'direccion_id');
    }
}

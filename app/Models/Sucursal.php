<?php

namespace App\Models;

use App\Direccion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sucursal extends Model
{
    use HasFactory;

    protected $table = 'sucursales';

    protected $fillable = [
        'direccion_id',
        'nro_sucursal',
        'departamento',
        'direccion_completa',
        'ciudad',
        'municipio',
        'en_operacion'
    ];


    public function direccion(): HasMany
    {
        return $this->hasMany(Direccion::class, 'direccion_id');
    }
}

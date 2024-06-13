<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\HasMany;

class Marca extends Model
{

    
use HasFactory;

protected  $fillable = [

   'nombre',
   'enlace',
   'imagen',
   'disponible',

];

protected $table = 'marcas';

    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class, 'marca_id');
    }
}

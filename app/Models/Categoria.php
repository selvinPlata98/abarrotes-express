<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{

    protected $fillable = [
        'nombre',
        'enlace',
        'imagen',
        'disponible'
    ];



    use HasFactory;
    public function productos() {
        return $this->hasmany(Producto::class,'categoria_id');
     }
}

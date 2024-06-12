<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'marca_id',
        'categoria_id',
        'nombre',
        'enlace',
        'imagenes',
        'descripcion',
        'precio',
        'disponible',
        'cantidad_disponible',
        'en_oferta',
        'porcentaje_oferta',
    ];

    protected $table = 'productos';


    public function categoria()
    {
        return $this->belongsTo(Categoria::class);

    }

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }


}

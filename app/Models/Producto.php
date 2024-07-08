<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    #Convertimos las imagenes en arreglos;
    protected $casts = ['imagenes' => 'array'];


    public function categoria()
    {
        return $this->belongsTo(Categoria::class);

    }

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function imagenes()
    {
        return $this->hasMany(Imagen::class);
    }

    public function elementosOrden(): HasMany
    {
        return $this->hasMany(ElementoOrden::class, 'producto_id');
    }




}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'codigo',
        'descuento',
        'fecha_inicio',
        'fecha_expiracion',
        'estado',
        'usuario_id',
        'orden_id',
        'producto_id',
        'categoria_id',
        'marca_id'
    ];

    protected $table = 'cupones';

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function orden()
    {
        return $this->belongsTo(Orden::class, 'orden_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }
}

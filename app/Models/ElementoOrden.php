<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ElementoOrden extends Model
{
    protected $table = 'elementos_ordenes';
    protected $fillable = ['orden_id', 'producto_id', 'cantidad','monto_unitario', 'monto_total', 'notas'];

    public function orden(): BelongsTo
    {
        return $this->belongsTo(Orden::class);
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }
}

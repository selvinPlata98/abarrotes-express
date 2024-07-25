<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Orden extends Model
{
    protected $table = 'ordenes';

    protected $fillable = ['user_id', 'sub_total', 'total_final', 'monto_unitario', 'metodo_pago', 'estado_pago', 'estado_entrega', 'costos_envio', 'notas'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function elementos(): HasMany
    {
        return $this->hasMany(ElementoOrden::class, 'orden_id');
    }

    public function producto(): HasMany
    {
        return $this->hasMany(Producto::class);
    }

    public function direccion(): HasOne
    {
        return $this->hasOne(Direccion::class);
    }


}

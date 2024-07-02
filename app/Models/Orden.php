<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Orden extends Model
{
    protected $table = 'ordenes';

    protected $fillable = ['user_id', 'sub_total', 'total_final', 'metodo_pago', 'estado_pago', 'estado_entrega', 'costos_envio'];
}

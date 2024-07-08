<?php

namespace App;

use App\Models\Orden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Direccion extends Model
{
    use HasFactory;

    protected $table = 'direcciones';

    public function orden(): BelongsTo
    {
        return $this->belongsTo(Orden::class);
    }
}

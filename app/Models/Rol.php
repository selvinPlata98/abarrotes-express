<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rol extends Model
{
    protected $table = 'roles';
    protected $fillable = 'nombre';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

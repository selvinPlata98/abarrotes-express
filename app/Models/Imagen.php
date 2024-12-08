<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Imagen extends Model
{
    protected $fillable = ['producto_id', 'filename', 'mime_type', 'file_size', 'image_data'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function getDecodedImagesAttribute()
    {
        return $this->imagenes->map(function ($image) {
            return [
                'name' => $image->filename,
                'mime' => $image->mime_type,
                'data' => base64_decode($image->image_data),
            ];
        });
    }
}

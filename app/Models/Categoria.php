<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Categoria extends Model
{

    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'enlace',
        'imagen',
        'disponible'
    ];

    protected $table = 'categorias';



    use HasFactory;
    public function productos() {
        return $this->hasmany(Producto::class,'categoria_id');
     }

<<<<<<< HEAD
     public function getImagenUrlAttribute()
     {
         return $this->imagen ? Storage::url($this->imagen) : null;
     }
=======
    public function cupones()
    {
        return $this->hasMany(Cupon::class, 'categoria_id');
    }
>>>>>>> l_ortez
}

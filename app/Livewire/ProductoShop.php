<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;


class ProductoShop extends Component
{
    public $producto;
    public $categoria;
    public $orden='';
    public $marca;
    public $paginacion = 10;
    public $categoriasFiltradas = [];

    public function filtro(){
        
    }

    public function filtrocate(){
        $query = Producto::query();
        if (!empty($this->categoriasFiltradas)) {
            $query->whereIn('categoria_id', $this->categoriasFiltradas);
        }
    }

    public function precio(){
        if ($this->orden === 'barato') {
            $this->producto = Producto::orderBy('precio', 'asc')->get();
        }
        else if($this->orden === 'caro'){
            $this->producto = Producto::orderBy('precio', 'desc')->get();
        } 
        
    }
    public function mount()
{
    $this->orden = '';
    $this->producto = Producto::all();
}

    public function render()
    {
        $this->categoria = Categoria::all();
        $this->marca = Marca::all();
        
        /*$query = Producto::query();   
        $productos = $query->paginate($this->paginacion);*/
        //$this->producto = Producto::all();
        

        return view('livewire.producto-shop');
    }

    
}

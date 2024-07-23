<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use Livewire\WithPagination;

class ProductoShop extends Component
{
    public $producto;
    public $categoria;
    public $orden='';
    public $marca;
    public $paginacion = 10;
    public $categoriasFiltradas = [];
    public $marcasFiltradas = [];
    

    
    public function filtrocate(){
        $query = Producto::query();

        if (!empty($this->categoriasFiltradas)) {
            $query->whereIn('categoria_id', $this->categoriasFiltradas);
        }
        $this->producto = $query->get();
    }

    public function filtromarcas(){
        $query = Producto::query();

        if (!empty($this->marcasFiltradas)) {
            $query->whereIn('marca_id', $this->marcasFiltradas);
        }
        $this->producto = $query->get();
    }
    
    public function precio(){
        if ($this->orden === 'barato') {
            $this->producto = Producto::orderBy('precio', 'asc')->get();
        }
        else if($this->orden === 'caro'){
            $this->producto = Producto::orderBy('precio', 'desc')->get();
        } 
        
    }
    

    public function mount() {
    $this->orden = '';
    $this->producto = Producto::all();
    $this->categoria = Categoria::all();
    $this->marca = Marca::all();
}


    public function render()
    {
        
        return view('livewire.producto-shop',[
            'productos' => $this->producto,
            'categorias' => $this->categoria,]);
    }

    
}

<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use Livewire\WithPagination;

class ProductoShop extends Component
{
    use WithPagination;
    
    public $producto;
    public $categoria;
    public $orden='';
    public $marca;
    public $perPage = 5;
    public $mostrarTodasCategorias = false;
    public $categoriasVisibles = 3;
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
        else if($this->orden === 'tiempo'){
            $this->producto = Producto::orderBy('created_at', 'asc')->get();
        } 
        
    }


    public function mostrarMas()
    {
        $this->mostrarTodasCategorias = true;
    }
    

    public function mount() {
    $this->orden = '';
    $this->producto = Producto::inRandomOrder()->get();
    $this->categoria = Categoria::all();
    $this->marca = Marca::all();
}


    public function render()
    {
        
        

        return view('livewire.producto-shop',[
            'producto' => $this->producto,
            'categoria' => $this->categoria,]);
    }

    
}

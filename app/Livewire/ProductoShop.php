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
 

    #[Title('Nuestro producto')]
    #[Url]

    
    
    public $productos;
    public $categorias;
    public $orden='';
    public $marcas;
    public $perPage = 3;
    public $mostrarTodasCategorias = false;
    public $categoriasVisibles = 3;
    public $categoriasFiltradas = [];
    public $marcasFiltradas = [];
    

    
    public function filtrocate(){
        $query = Producto::query();

        if (!empty($this->categoriasFiltradas)) {
            $query->whereIn('categoria_id', $this->categoriasFiltradas);
        }
        $this->productos = $query->get();
    }


    public function filtromarcas(){
        $query = Producto::query();

        if (!empty($this->marcasFiltradas)) {
            $query->whereIn('marca_id', $this->marcasFiltradas);
        }
        $this->productos = $query->get();
        $productos = $query->paginate($this->perPage);
    }
    
    public function precio(){
        if ($this->orden === 'barato') {
            $this->productos = Producto::orderBy('precio', 'asc')->get();
        }
        else if($this->orden === 'caro'){
            $this->productos = Producto::orderBy('precio', 'desc')->get();
        } 
        else if($this->orden === 'tiempo'){
            $this->productos = Producto::orderBy('created_at', 'asc')->get();
        } 
        
    }


    public function mostrarMas()
    {
        $this->mostrarTodasCategorias = true;
    }
    

    public function mount() {
    $this->orden = '';
    $this->productos = Producto::inRandomOrder()->get();
    //$this->producto = Producto::paginate($this->perPage);
    
    $this->categorias = Categoria::all();
    $this->marcas = Marca::all();
}


    public function render()
    {
        
        

        return view('livewire.producto-shop',[
            'productos' => $this->productos,
            'categorias' => $this->categorias,
            'productos' => $this->productos,
        ]);
    }

    
}

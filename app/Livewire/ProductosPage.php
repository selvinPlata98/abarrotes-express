<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use Livewire\WithPagination;

class ProductosPage extends Component
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
    public $mostrarTodasMarcas = false;
    public $marcasVisibles = 3;
    public $categoriasFiltradas = [];
    public $marcasFiltradas = [];
    

    public function filtromarcas(){
        $query = Producto::query();

    // Filtrar por categorías
    if (!empty($this->categoriasFiltradas)) {
        $query->whereIn('categoria_id', $this->categoriasFiltradas);
    }

    // Filtrar por marcas
    if (!empty($this->marcasFiltradas)) {
        $query->whereIn('marca_id', $this->marcasFiltradas);
    }

    // Nueva condición: filtrar por categorías y marcas simultáneamente
    if (!empty($this->categoriasFiltradas) && !empty($this->marcasFiltradas)) {
        $query->whereIn('categoria_id', $this->categoriasFiltradas)
              ->whereIn('marca_id', $this->marcasFiltradas);
    }

    // Obtener los productos filtrados
    $this->productos = $query->get();
    
    }
    
    public function precio(){
        if ($this->orden === 'barato') {
            $this->productos = Producto::orderBy('precio', 'asc')->get();
        }
        else if($this->orden === 'caro'){
            $this->productos = Producto::orderBy('precio', 'desc')->get();
        } 
        else if($this->orden === 'tiempo'){
            $this->productos = Producto::orderBy('created_at', 'desc')->get();
        } 
        
    }

    public function toggleCategorias()
    {
        $this->mostrarTodasCategorias = !$this->mostrarTodasCategorias;
    }

    public function toggleMarcas()
    {
        $this->mostrarTodasMarcas = !$this->mostrarTodasMarcas;
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
        return view('livewire.productos-page',[
            'productos' => $this->productos,
            'categorias' => $this->categorias,
            'productos' => $this->productos,
        ]);
    }
}

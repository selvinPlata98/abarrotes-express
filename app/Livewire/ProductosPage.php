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
    public $categorias;
    public $orden = '';
    public $marcas;
    public $perPage = 4;
    public $mostrarTodasCategorias = false;
    public $categoriasVisibles = 3;
    public $mostrarTodasMarcas = false;
    public $marcasVisibles = 3;
    public $categoriasFiltradas = [];
    public $marcasFiltradas = [];

    protected $queryString = ['categoriasFiltradas', 'marcasFiltradas', 'orden'];

    public function updatedCategoriasFiltradas()
    {
        $this->resetPage();
    }

    public function updatedMarcasFiltradas()
    {
        $this->resetPage();
    }

    public function updatedOrden()
    {
        $this->resetPage();
    }

    public function filtromarcas()
    {
        $this->resetPage();
    }

    public function precio()
    {
        $this->resetPage();
    }

    public function toggleCategorias()
{
    $this->mostrarTodasCategorias = !$this->mostrarTodasCategorias;
}

public function toggleMarcas()
{
    $this->mostrarTodasMarcas = !$this->mostrarTodasMarcas;
}

    public function mount() 
    {
        $this->categorias = Categoria::all();
        $this->marcas = Marca::all();
        $this->mostrarTodasCategorias = false; // Asegúrate de inicializar esto
        $this->mostrarTodasMarcas = false;
    }

    public function render()
    {
        $query = Producto::query();

        if (!empty($this->categoriasFiltradas)) {
            $query->whereIn('categoria_id', $this->categoriasFiltradas);
        }
        if (!empty($this->marcasFiltradas)) {
            $query->whereIn('marca_id', $this->marcasFiltradas);
        }

        switch ($this->orden) {
            case 'barato':
                $query->orderBy('precio', 'asc');
                break;
            case 'caro':
                $query->orderBy('precio', 'desc');
                break;
            case 'tiempo':
                $query->orderBy('created_at', 'desc');
                break;
            
        }

        $productos = $query->paginate($this->perPage);

        return view('livewire.productos-page', [
            'productos' => $productos,
            'categorias' => $this->categorias,
        ]);
    }
}

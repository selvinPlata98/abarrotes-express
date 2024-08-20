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
    public $precio =0;
    public $precioMaximo;
    public $precioMinimo = 0;
    public $categorias;
    public $orden = '';
    public $marcas;
    public $perPage = 5;
    public $mostrarTodasCategorias = false;
    public $categoriasVisibles = 5;
    public $mostrarTodasMarcas = false;
    public $marcasVisibles = 5;
    public $categoriasFiltradas = [];
    public $marcasFiltradas = [];
    public $categoriaSeleccionada = null;
    public $MarcaSeleccionada = null;

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

    public function precios()
    {
        $this->resetPage();
    }
    public function updatedPrecio()
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







public function seleccionarCategoria($categoriaId)
{
    // Aquí puedes agregar la lógica para seleccionar la categoría
    $this->categoriasFiltradas = [$categoriaId]; // Asigna la categoría seleccionada
    $this->resetPage(); // Resetea la paginación
}

    public function seleccionarMarcas($marcaId)
{
    // Aquí puedes agregar la lógica para seleccionar la categoría
    $this->marcasFiltradas = [$marcaId]; // Asigna la categoría seleccionada
    $this->resetPage(); // Resetea la paginación
}
    public function mount($categoria = null, $marca = null) 
    {
        $this->categorias = Categoria::all();
        $this->marcas = Marca::all();
        $this->mostrarTodasCategorias = false; // Asegúrate de inicializar esto
        $this->precioMaximo = Producto::max('precio');
        $this->precio = $this->precioMaximo;
        $this->mostrarTodasMarcas = false;

        
        // valida las categoria que se selecciona por el id si es true
        if ($categoria) {
            $this->categoriasFiltradas = [$categoria];
        } 
        // valida las marcas que se selecciona por el id si es true
        if ($marca) {
            $this->marcasFiltradas = [$marca];
        }
    }

    public function render()
    {
        $query = Producto::query();
        // seleciona los productos relacionado con el id de las marcas
        if (!empty($this->marcasFiltradas)) {
            $query->whereIn('marca_id', $this->marcasFiltradas);
        }
        
        if ($this->precio > 0) {
            $query->where('precio', '<=', $this->precio); // Ajusta el límite inferior
        }
        // seleciona los productos relacionado con el id de las categorias
         if (!empty($this->categoriasFiltradas)) {
            $query->whereIn('categoria_id', $this->categoriasFiltradas);
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
            'marcas' => $this->marcas,
        ]);
    }
}

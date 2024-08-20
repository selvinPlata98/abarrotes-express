<?php

namespace App\Livewire;

use App\Helpers\CarritoManagement;
use App\Livewire\Complementos\Navbar;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use Livewire\WithPagination;

class ProductosPage extends Component
{
    use WithPagination;
    use LivewireAlert;

    #[Title('Productos')]
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

    protected $queryString = ['categoriasFiltradas', 'marcasFiltradas', 'orden'];

    public function agregarCarrito($producto_id)
    {
        $conteo_total = CarritoManagement::agregarElmentoAlCarrito($producto_id);

        if (is_numeric($conteo_total)) {
            // Si la operación fue exitosa y se devuelve el conteo total
            $this->dispatch('update-cart-count', ['conteo_total' => $conteo_total])->to(Navbar::class);
            $this->alert('success', 'El producto fue agregado al carrito', [
                'position' => 'bottom-end',
                'timer' => 2000,
                'toast' => true,
                'timerProgressBar' => true,
                $this->skipRender()
            ]);
        } else {
            // Si se devuelve un mensaje de error
            $this->alert('error', $conteo_total, [
                'position' => 'bottom-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
                $this->skipRender()
            ]);
        }
    }

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

        if (!empty($this->categoriasFiltradas)) {
            $query->whereIn('categoria_id', $this->categoriasFiltradas);
        }
        if (!empty($this->marcasFiltradas)) {
            $query->whereIn('marca_id', $this->marcasFiltradas);
        }

        if ($this->precio > 0) {
            $query->where('precio', '<=', $this->precio); // Ajusta el límite inferior
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

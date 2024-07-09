<!-- resources/views/livewire/mostrar-categorias.blade.php -->

<div>
    <h1>Lista de Categorías</h1>
    <ul>
        @foreach($categorias as $categoria)
            <li>{{ $categoria->nombre }}</li>
        @endforeach
    </ul>
</div>

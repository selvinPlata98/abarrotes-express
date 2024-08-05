<?php


use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', \App\Livewire\InicioPage::class)->name('inicio');
Route::get('/inicio', function (){
    return redirect()->route('inicio');
});
Route::get('/home', function (){
    return redirect()->route('inicio');
});


Route::get('/categorias', \App\Livewire\MostrarCategoriaPage::class);
Route::get('/marcas', \App\Livewire\MostrarMarcaPage::class);
Route::get('/producto/{enlace}', \App\Livewire\ProductoPage::class)->name('producto');;
Route::get('/error', \App\Livewire\ErrorPage::class);
Route::get('/productos/{categoria?}/{marca?}', \App\Livewire\ProductosPage::class)->name('productos');


Route::middleware('guest')->group(function (){
    Route::get('/registro', \App\Livewire\Auth\RegistroPage::class)->name('registro');
    Route::get('/login', \App\Livewire\Auth\LoginPage::class)->name('login');
});




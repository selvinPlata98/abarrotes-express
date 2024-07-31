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

Route::get('/home', function (){
    return redirect()->route('inicio');
} );


Route::get('/categorias', \App\Livewire\MostrarCategoriaPage::class);
Route::get('/marcas', \App\Livewire\MostrarMarcaPage::class);
Route::get('/productoshop/{categoria?}/{marca?}', \App\Livewire\ProductoShop::class)->name('productoshop');
Route::get('/producto/{enlace}', \App\Livewire\ProductoPage::class);
Route::get('/error', \App\Livewire\ErrorPage::class);

Route::middleware('guest')->group(function (){
    Route::get('/registro', \App\Livewire\Auth\RegistroPage::class)->name('registro');
    Route::get('/login', \App\Livewire\Auth\LoginPage::class)->name('login');
});



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

Route::get('/inicio', function () {
    return view('inicio');
})->name('inicio');


Route::get('/login', function (){
    return view('login');
})->name('login');

Route::get('/categoria', function (){
    return view('mostrar-categoria');
});

Route::get('/error404', function () {
    return view('error404');
})->name('error404');


Route::get('/registro', function () {
    return view('registro');
})->name('registro');

<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\MenuController;

Route::get('/menu', [MenuController::class, 'index']);
Route::post('/carrito/agregar/{id}', [MenuController::class, 'agregarAlCarrito']);
Route::get('/carrito', [MenuController::class, 'verCarrito']);
Route::post('/carrito/confirmar', [MenuController::class, 'confirmarPedido']);
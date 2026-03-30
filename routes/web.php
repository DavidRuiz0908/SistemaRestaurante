<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CocinaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/menu', [MenuController::class, 'index']);
Route::post('/carrito/agregar/{id}', [MenuController::class, 'agregarAlCarrito']);
Route::get('/carrito', [MenuController::class, 'verCarrito']);
Route::post('/carrito/confirmar', [MenuController::class, 'confirmarPedido']); 
Route::get('/cocina', [CocinaController::class, 'index']);
Route::post('/cocina/completar/{id}', [CocinaController::class, 'completar']);
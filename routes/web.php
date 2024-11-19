<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibroController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth:sanctum', 'verified'])->prefix('dashboard')->group(function () {
    // Esta ruta mostrará los libros en el dashboard
    Route::get('/', [LibroController::class, 'index'])->name('dashboard');

    // Rutas de recursos para libros
    Route::resource('libros', LibroController::class);
    Route::post('libros/{libro}/toggle-estado', [LibroController::class, 'toggleEstado'])->name('libros.toggleEstado');
    Route::get('/libros/{libro}/edit', [LibroController::class, 'edit'])->name('libros.edit');
    Route::put('/libros/{libro}', [LibroController::class, 'update'])->name('libros.update');
});

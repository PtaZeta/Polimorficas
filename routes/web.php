<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\ComentarioController;
use App\Models\Imagen;

Route::get('/', function () {
    return view('principal', [
        'imagenes' => Imagen::whereNull('deleted_at') // Evita mostrar imágenes eliminadas
                        ->orderBy('created_at', 'desc')
                        ->paginate(9),
    ]);
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grupo de rutas protegidas para autenticados
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas protegidas para imágenes (CRUD completo)
    Route::resource('imagenes', ImagenController::class)->except(['index', 'show']);

    // Guardar comentarios (protegido)
    Route::post('/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');
});

// Mostrar imágenes sin restricciones (index y show)
Route::resource('imagenes', ImagenController::class)->only(['index', 'show']);

require __DIR__.'/auth.php';

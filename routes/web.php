<?php

use Illuminate\Support\Facades\Route;
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');

    Route::get('/imagenes', [ImagenController::class, 'index'])->name('imagenes.index');
    Route::get('/imagenes/create', [ImagenController::class, 'create'])->name('imagenes.create');
    Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');
    Route::get('/imagenes/{imagen}', [ImagenController::class, 'show'])->name('imagenes.show');
    Route::get('/imagenes/{imagen}/edit', [ImagenController::class, 'edit'])->name('imagenes.edit');
    Route::put('/imagenes/{imagen}', [ImagenController::class, 'update'])->name('imagenes.update');
    Route::delete('/imagenes/{imagen}', [ImagenController::class, 'destroy'])->name('imagenes.destroy');
});

require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\ComentarioController;
use App\Models\Imagen;

Route::get('/', function () {
    return view('principal', [
        'imagenes' => Imagen::orderBy('created_at', 'desc')->paginate(9),
    ]);
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('imagenes', ImagenController::class);

Route::post('/comentarios', [ComentarioController::class, 'store'])->name('comentarios.store');

require __DIR__.'/auth.php';

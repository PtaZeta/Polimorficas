<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImagenRequest;
use App\Http\Requests\UpdateImagenRequest;
use Illuminate\Http\Request;
use App\Models\Imagen;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ImagenController extends BaseController
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check())
            return view('imagenes.create');
        else
            return redirect()->route('login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImagenRequest $request)
    {
        // Crear la imagen
        $imagen = new Imagen($request->input());
        $imagen->user_id = Auth::id();
        // Manejar la subida de imagen
        if ($request->hasFile('url')) {
            $archivo = $request->file('url');
            $archivo->storeAs('imagenes', $imagen->id, 'public');
            $imagen->url = asset("storage/imagenes/{$imagen->id}");
        }

        $imagen->save();

        // Manejar la subida de imagen
        if ($request->hasFile('url')) {
            $archivo = $request->file('url');
            $archivo->storeAs('imagenes', $imagen->id, 'public');
            $imagen->url = asset("storage/imagenes/{$imagen->id}");
            $imagen->save();
        }

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $imagen = Imagen::find($id);
        return view('imagenes.show', compact('imagen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Imagen $imagen)
    {
        Gate::authorize('update', $imagen);

        return view('imagenes.edit', [
            'imagen' => $imagen,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImagenRequest $request, Imagen $imagen)
    {
        Gate::authorize('update', $imagen);

        $imagen->fill($request->input());
        $imagen->save();
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $imagen = Imagen::findOrFail($id);
        $imagen->delete();

        return redirect()->back()->with('success', 'Imagen eliminada correctamente.');
    }
}

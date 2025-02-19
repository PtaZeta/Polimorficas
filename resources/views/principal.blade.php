<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería de Imágenes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.0.0/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.5.0/dist/flowbite.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Imágenes') }}
            </h2>
        </x-slot>
        <div class="container mx-auto p-6">
            <h1 class="text-3xl font-semibold mb-6 text-center text-gray-800">Galería de Imágenes</h1>

            <div class="flex justify-end mb-4">
                <a href="{{ route('imagenes.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Crear Imagen</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
                @foreach($imagenes as $imagen)
                    <x-imagen :imagen="$imagen" />
                @endforeach
            </div>

            <div class="mt-2">
                {{ $imagenes->links() }}
            </div>
        </div>
    </x-app-layout>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.5.0/dist/flowbite.min.js"></script>
</body>
</html>

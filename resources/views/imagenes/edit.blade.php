<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Imagen</title>
    <!-- Flowbite CSS -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.5.4/dist/flowbite.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mx-auto p-4">
        <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-center mb-6">Editar Imagen</h2>

            <!-- Mensajes de error y éxito -->
            @if (session('success'))
                <div class="text-green-600 mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="text-red-600 mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulario de edición -->
            <form action="{{ route('imagenes.update', $imagen->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción:</label>
                    <input type="text" id="descripcion" name="descripcion" value="{{ $imagen->descripcion }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="url" class="block text-sm font-medium text-gray-700">Imagen:</label>
                    <input type="file" id="url" name="url" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @if($imagen->url)
                        <img src="{{ $imagen->url }}" alt="Imagen actual" class="mt-2 max-w-xs max-h-xs rounded-md">
                    @endif
                </div>

                <div class="text-center">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Actualizar Imagen</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Flowbite JS -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.5.4/dist/flowbite.min.js"></script>
</body>

</html>

@props(['imagen'])
<div class="bg-white shadow-lg rounded-lg overflow-hidden">
    <a href="{{ route('imagenes.show', $imagen)}}">
        <img src="{{ $imagen->url }}" alt="{{ $imagen->descripcion }}" class="w-full h-48 object-cover">
        <div class="p-4">
            <p class="text-gray-600 text-sm">{{ $imagen->descripcion }}</p>
            <p class="mt-2 text-sm text-gray-500"><b>Subida por:</b> {{ $imagen->user->name }}</p>
            <div class="flex space-x-2 mt-4">
                @can('update', $imagen)
                    <a href="{{ route('imagenes.edit', $imagen) }}">
                        <button type="button" class="px-2 py-1 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Editar</button>
                    </a>
                @endcan
                @can('delete', $imagen)
                    <form class="inline" method="POST" action="{{ route('imagenes.destroy', $imagen) }}">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="px-2 py-1 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Borrar</button>
                    </form>
                @endcan
            </div>
        </div>
    </a>
</div>


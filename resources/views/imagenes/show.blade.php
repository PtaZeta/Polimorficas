<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ver imagen
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center">
        <figure class="max-w-4xl text-center">
            <img class="h-auto w-full rounded-lg mx-auto" src="{{ $imagen->url }}" alt="image description">
            <p class="mt-4 text-xl text-gray-500 dark:text-gray-400">{{ $imagen->descripcion }}</p>
            <button onclick="setCommentable({{ $imagen->id }}, 'App\\Models\\Imagen')" class="mt-2 px-2 py-1 bg-blue-500 text-white rounded">Añadir comentario</button>
        </figure>
    </div>

    <div class="py-12 flex justify-center">
        <div class="max-w-4xl w-full">
            <h3 class="text-2xl font-semibold text-gray-800 leading-tight mb-4">Comentarios</h3>

            <div id="comments">
                @foreach ($imagen->comentarios as $comentario)
                    <x-comentario :comentario="$comentario" />
                @endforeach
            </div>

            <!-- Formulario para añadir comentarios -->
            <form action="{{ route('comentarios.store') }}" method="POST" id="commentForm" class="hidden bg-gray-100 p-4 rounded-lg shadow">
                @csrf
                <input type="hidden" name="comentable_id" id="comentable_id" value="{{ $imagen->id }}">
                <input type="hidden" name="comentable_type" id="comentable_type" value="App\Models\Imagen">
                <div class="mb-4">
                    <label for="contenido" class="block text-gray-700">Añadir comentario:</label>
                    <textarea id="contenido" name="contenido" rows="4" class="w-full mt-2 p-2 border rounded-lg" required></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Enviar</button>
                </div>
            </form>
        </div>
    </div>

    @once
        <script>
            function setCommentable(id, type, parentId = null) {
                document.getElementById('comentable_id').value = id;
                document.getElementById('comentable_type').value = type;
                const form = document.getElementById('commentForm');

                form.classList.remove('hidden');
                if (parentId) {
                    document.getElementById('comentario-' + parentId).appendChild(form);
                } else {
                    document.querySelector('figure').appendChild(form);
                }

                document.getElementById('contenido').focus();
            }
        </script>
    @endonce
</x-app-layout>

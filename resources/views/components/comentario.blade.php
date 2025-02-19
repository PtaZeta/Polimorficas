<div class="mb-4 p-4 bg-white rounded-lg shadow" id="comentario-{{ $comentario->id }}">
    <p class="text-gray-700"><strong>{{ $comentario->user->name }}:</strong> {{ $comentario->contenido }}</p>
    <p class="text-gray-500 text-sm">{{ $comentario->created_at->timezone('Europe/Madrid')->format('d/m/Y H:i') }}</p>
    <button onclick="setCommentable({{ $comentario->id }}, 'App\\Models\\Comentario', {{ $comentario->id }})" class="ml-2 px-2 py-1 bg-gray-500 text-white rounded">Responder</button>

    @if ($comentario->buscarComentarios->isNotEmpty())
        <div class="ml-4">
            @foreach ($comentario->buscarComentarios as $subComentario)
                <x-comentario :comentario="$subComentario" />
            @endforeach
        </div>
    @endif
</div>

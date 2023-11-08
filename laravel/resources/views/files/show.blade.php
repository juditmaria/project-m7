<div class="container">
    <h1>Detalles del archivo</h1>
    <p>ID: {{ $file->id }}</p>
    <p>File Path: {{ $file->filepath }}</p>
    <p>File Size: {{ $file->filesize }}</p>
    <img class="img-fluid" src="{{ asset("storage/{$file->filepath}") }}" alt="{{ $file->filepath }}" />

    <form action="{{ route('files.destroy', $file) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>

    <a href="{{ route('files.edit', $file) }}" class="btn btn-primary">Editar</a>
</div>
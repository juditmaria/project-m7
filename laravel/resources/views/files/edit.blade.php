<div class="container">
    <h1>Editar Archivo</h1>
    <form action="{{ route('files.update', $file->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="upload">Seleccionar Archivo</label>
            <input type="file" name="upload" id="upload" class="form-control" onchange="updateFileSize(this)">
        </div>

        <div class="form-group">
            <label for="filesize">Tamaño del archivo (bytes)</label>
            <input type="text" name="filesize" id="filesize" class="form-control" value="{{ $file->filesize }}">
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>

<script>
function updateFileSize(input) {
    const selectedFile = input.files[0];
    const fileSize = selectedFile.size; // Tamaño del archivo en bytes
    document.getElementById('filesize').value = fileSize; // Actualiza el campo de texto con el tamaño en bytes
}
</script>

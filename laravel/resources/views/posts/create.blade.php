<h1>Crear nuevo Post</h1>

<form method="post" action="{{ route('files.store') }}" enctype="multipart/form-data">
    @csrf
    <label for="upload">File:</label>
    <input type="file" class="form-control" name="upload"/>

    <label for="body">Cuerpo del Post:</label>
    <textarea name="body" required></textarea>

    <label for="latitude">Latitud:</label>
    <input type="text" name="latitude" required>

    <label for="longitude">Longitud:</label>
    <input type="text" name="longitude" required>

    <button type="submit">Crear Post</button>
</form>

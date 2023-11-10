<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function index()
    {
        $posts = Post::with(['user', 'file'])->get();
        return view('posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        // Validar el formulario si es necesario
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'file' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048', // Ajusta según tus necesidades
        ]);

        // Subir el archivo al almacenamiento (storage)
        $uploadedFile = $request->file('file'); // Asegúrate de tener un campo de archivo en tu formulario

        // Verificar si la subida del archivo fue exitosa
        if (!$uploadedFile) {
            // Manejar el caso en que la subida del archivo falla
            return redirect()->back()->with('error', 'Error al subir el archivo');
        }

        // Guardar el archivo en el almacenamiento y obtener la ruta
        $filePath = Storage::putFile('files', $uploadedFile);

        // Verificar si la subida del archivo fue exitosa
        if (!$filePath) {
            // Manejar el caso en que la subida del archivo falla
            return redirect()->back()->with('error', 'Error al subir el archivo');
        }

        // Crear un nuevo registro en la tabla files
        $file = new File(['filepath' => $filePath]);
        $file->save();
        $fileId = $file->id;

        // Obtener las relaciones y datos del formulario
        $authorId = auth()->id();

        // Crear un nuevo registro en la tabla posts
        $post = new Post([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'author_id' => $authorId,
            'file_id' => $fileId,
        ]);
        $post->save();

        return redirect()->route('dashboard')->with('success', 'Post creado exitosamente.');
    }
}

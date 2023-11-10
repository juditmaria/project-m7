<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("files.index", [
            "files" => File::all()
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("files.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
   {
       // Validar fitxer
       $validatedData = $request->validate([
           'upload' => 'required|mimes:gif,jpeg,jpg,png|max:1024'
       ]);
      
       // Obtenir dades del fitxer
       $upload = $request->file('upload');
       $fileName = $upload->getClientOriginalName();
       $fileSize = $upload->getSize();
       \Log::debug("Storing file '{$fileName}' ($fileSize)...");


       // Pujar fitxer al disc dur
       $uploadName = time() . '_' . $fileName;
       $filePath = $upload->storeAs(
           'uploads',      // Path
           $uploadName ,   // Filename
           'public'        // Disk
       );
      
       if (\Storage::disk('public')->exists($filePath)) {
           \Log::debug("Disk storage OK");
           $fullPath = \Storage::disk('public')->path($filePath);
           \Log::debug("File saved at {$fullPath}");
           // Desar dades a BD
           $file = File::create([
               'filepath' => $filePath,
               'filesize' => $fileSize,
           ]);
           \Log::debug("DB storage OK");
           // Patró PRG amb missatge d'èxit
           return redirect()->route('files.show', $file)
               ->with('success', 'File successfully saved');
       } else {
           \Log::debug("Disk storage FAILS");
           // Patró PRG amb missatge d'error
           return redirect()->route("files.create")
               ->with('error', 'ERROR uploading file');
       }
   }


    /**
     * Display the specified resource.
     */
    public function show($id)
{
    $file = File::find($id);

    if (!$file) {
        return redirect()->route('files.index')->with('error', 'El archivo no existe.');
    }

    $filePath = storage_path("app/public/{$file->filepath}");

    if (!Storage::exists("public/{$file->filepath}") || !file_exists($filePath)) {
        return redirect()->route('files.index')->with('error', 'El archivo no se encuentra en el disco.');
    }

    return view('files.show', compact('file'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $file = File::find($id);

        if (!$file) {
            return redirect()->route('files.index')->with('error', 'El archivo no existe.');
        }

        return view('files.edit', compact('file'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, File $file)
    {
        $request->validate([
            'upload' => 'required|file',
        ]);
    
        if ($request->hasFile('upload')) {
            $uploadedFile = $request->file('upload');
            $fileName = 'uploads/' . $uploadedFile->getClientOriginalName();
            $uploadedFile->storeAs('', $fileName, 'public');
    
            $file->filepath = $fileName;
            $file->filesize = $uploadedFile->getSize(); // Actualiza el campo filesize con el nuevo tamaño en bytes
            $file->save();
        }
    
        return redirect()->route('files.show', $file)->with('success', 'Archivo actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $file = File::find($id);
    
        if (!$file) {
            return redirect()->route('files.index')->with('error', 'El archivo no existe.');
        }
    
        // Eliminar el archivo del sistema de archivos
        Storage::delete("public/{$file->filepath}");
    
        // Obtener el nombre de la tabla
        $tableName = $file->getTable();
    
        // Eliminar el registro de la base de datos
        $file->delete();
    
        
/*         // Reiniciar la secuencia de ID (autoincrement) en la base de datos
        DB::statement("ALTER TABLE {$tableName} AUTO_INCREMENT = 1"); */
/* 
        $databaseDriver = config('database.default');

        $tableName = 'files'; // Reemplaza con el nombre de tu tabla
    
        // Verifica el driver y ejecuta el comando correspondiente
        if ($databaseDriver === 'mysql') {
            DB::statement("ALTER TABLE {$tableName} AUTO_INCREMENT = 1");
        } elseif ($databaseDriver === 'sqlite') {
            DB::statement("UPDATE sqlite_sequence SET seq = 1 WHERE name = '{$tableName}'");
        } */
    
        return redirect()->route('files.index')->with('success', 'Archivo eliminado exitosamente.');
    }    

}
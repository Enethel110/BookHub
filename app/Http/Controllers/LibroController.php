<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    /**
     * Mostrar los recursos y filtrado por titulo y autor de los libros
     * con paguinacion de 12 libros
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        // Buscar libros por título o autor
        if ($search) {
            $libros = Libro::where('titulo', 'like', '%' . $search . '%')
                ->orWhere('autor', 'like', '%' . $search . '%')
                ->paginate(12);
        } else {
            // Mostrar todos los libros con paginación
            $libros = Libro::paginate(12);
        }


        $librosArray = $libros->items();
        return view('dashboard', compact('libros', 'librosArray'));
    }

    /**
     * Almacenar un nuevo libro en la DB.
     */
    public function store(Request $request)
    {
        // Validación de los datos ingresados
        $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
        ]);
        // Crear un nuevo libro en la base de datos
        Libro::create($request->all());

        return redirect()->route('libros.index')->with('success', 'Libro creado correctamente.');
    }
    /**
     * Mostrar el contenido de un libro.
     */
    public function show(Libro $libro)
    {
        // Mostrar la vista con los detalles del libro
        return view('libros.show', compact('libro'));
    }

    /**
     * Mostrar el formulario para editar el libro especificado.
     */
    public function edit(Libro $libro)
    {
        // Retornar los datos del libro en formato JSON para la edición
        return response()->json($libro);
    }
    /**
     * Actualizar el libro especificado en almacenamiento.
     */
    public function update(Request $request, Libro $libro)
    {
        // Validación de los datos ingresados
        $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
        ]);
        // Actualizar los datos del libro en la base de datos
        $libro->update($request->all());
        return redirect()->route('libros.index')->with('success', 'Libro actualizado correctamente.');
    }

    /**
     * Eliminar el libro especificado del almacenamiento.
     */
    public function destroy(Libro $libro)
    {
        $libro->delete();
        return redirect()->route('libros.index')->with('success', 'Libro eliminado correctamente.');
    }

    /**
     * Cambiar el estado del libro (disponible o prestado).
     */
    public function toggleEstado(Libro $libro)
    {
        // Cambiar estado de disponible a prestado o viceversa
        $libro->estado = $libro->estado === 'disponible' ? 'prestado' : 'disponible';
        $libro->save();
        return redirect()->route('libros.index')->with('success', 'Estado del libro actualizado.');
    }
}

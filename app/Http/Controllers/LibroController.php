<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        if ($search) {
            $libros = Libro::where('titulo', 'like', '%' . $search . '%')
                ->orWhere('autor', 'like', '%' . $search . '%')
                ->paginate(12);
        } else {
            $libros = Libro::paginate(12);
        }
    
       
        $librosArray = $libros->items();
        return view('dashboard', compact('libros', 'librosArray'));
    }
    

    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('libros.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
        ]);

        Libro::create($request->all());

        return redirect()->route('libros.index')->with('success', 'Libro creado correctamente.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Libro $libro)
    {
        return view('libros.show', compact('libro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Libro $libro)
    {
        return response()->json($libro);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Libro $libro)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
        ]);

        $libro->update($request->all());
        return redirect()->route('libros.index')->with('success', 'Libro actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Libro $libro)
    {
        $libro->delete();
        return redirect()->route('libros.index')->with('success', 'Libro eliminado correctamente.');
    }

    /**
     * Toggle the estado of the book (available or borrowed).
     */
    public function toggleEstado(Libro $libro)
    {
        // Cambiar estado de disponible a prestado o viceversa
        $libro->estado = $libro->estado === 'disponible' ? 'prestado' : 'disponible';
        $libro->save();
        return redirect()->route('libros.index')->with('success', 'Estado del libro actualizado.');
    }
}

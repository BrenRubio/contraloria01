<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\SegComite;

class ceaa_contraloria_segComite extends Controller
{
    public function index()
    {
        $visitas = SegComite::all();
        return view('ceaa_contraloria.seguimientoComite', compact('visitas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_visita' => 'required|string|max:255',
            'documento' => 'required|file|max:5120|mimes:jpg,jpeg,png,pdf,doc,docx'
        ]);

        $documentoPath = $request->file('documento')->store('documentos', 'public');

        SegComite::create([
            'nombre_visita' => $request->nombre_visita,
            'documento' => $documentoPath
        ]);

        return redirect()->route('segComite.index')->with('success', 'Visita agregada con éxito.');
    }

    public function destroy(Request $request)
    {
        $ids = $request->input('visitas');

        if (!$ids) {
            return redirect()->route('segComite.index')->with('error', 'No se seleccionaron visitas para eliminar.');
        }

        SegComite::destroy($ids); // Eliminar las visitas

        return redirect()->route('segComite.index')->with('success', 'Visitas eliminadas con éxito.');
    }
    
}

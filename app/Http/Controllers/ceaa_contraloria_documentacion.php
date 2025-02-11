<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documentacion;
use Illuminate\Support\Facades\Storage;
use App\Models\Beneficiarios;


class ceaa_contraloria_documentacion extends Controller
{
    /**
     * Muestra la vista principal con los documentos registrados.
     */

     public function index()
     {
         $documentos = Documentacion::all();
         $beneficiarios = Beneficiarios::all(); // 🔥 Obtener todos los comités existentes
     
         return view('ceaa_contraloria.documentacion', compact('documentos', 'beneficiarios'));
     }
     

    /**
     * Almacena un nuevo documento en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'beneficiario_id' => 'required|exists:beneficiarios,id', // ✅ Asegurar que existe en la tabla beneficiarios
            'descripcion' => 'nullable|string|max:1000',
            'tipo' => 'required|string|in:Plano,Catálogo,Programa de Obra',
            'archivo' => 'required|file|mimes:pdf,docx,xlsx,jpg,png|max:2048',
        ], [
            'beneficiario_id.required' => 'Debe seleccionar un comité.',
            'beneficiario_id.exists' => 'El comité seleccionado no existe.',
        ]);

        // Guardar el archivo en storage si está presente
        if ($request->hasFile('archivo')) {
            $validated['archivo'] = $request->file('archivo')->store('documentos', 'public');
        }

        // Crear el documento con el beneficiario asociado
        Documentacion::create([
            'beneficiario_id' => $request->beneficiario_id,
            'descripcion' => $validated['descripcion'],
            'tipo' => $validated['tipo'],
            'archivo' => $validated['archivo'],
        ]);

        return redirect()->route('documentacion.index')->with('success', 'Documento agregado con éxito.');
    }

    /**
     * Elimina un documento de la base de datos.
     */
    public function destroy($id)
    {
        $documento = Documentacion::findOrFail($id);

        // Validar si el archivo existe antes de eliminarlo
        if ($documento->archivo && Storage::exists('public/' . $documento->archivo)) {
            Storage::delete('public/' . $documento->archivo);
        }

        $documento->delete();

        return redirect()->route('documentacion.index')->with('success', 'Documento eliminado con éxito.');
    }
}
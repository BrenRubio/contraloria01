<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quejas;
use App\Models\Beneficiarios;

class ceaa_contraloria_quejas extends Controller
{
    /**
     * Mostrar todas las quejas en el buzón.
     */
    public function index()
    {
        $quejas = Quejas::all();
        return view('ceaa_contraloria.buzon', compact('quejas'));
    }

    /**
     * Mostrar formulario para crear una queja.
     */
    public function create()
    {
        $beneficiarios = Beneficiarios::all();
        return view('ceaa_contraloria.quejas', compact('beneficiarios'));
    }

    /**
     * Almacenar una nueva queja en la base de datos con validaciones dentro del controlador.
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'asunto' => 'required|string|max:255',
        'nombre_opcional' => 'nullable|string|max:255',
        'nombre_reportado' => 'required|string|max:255',
        'motivo' => 'required|string|min:10',
        'evidencia.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'clave_comite' => 'required|exists:beneficiarios,clave_comite', // 🔥 Verifica que la clave existe
    ], [
        'clave_comite.required' => 'La clave del comité es obligatoria.',
        'clave_comite.exists' => 'La clave del comité no está registrada en el sistema.',
    ]);

    // Obtener el comité relacionado
    $beneficiario = Beneficiarios::where('clave_comite', $request->clave_comite)->firstOrFail();

    // Procesar archivos de evidencia si existen
    if ($request->hasFile('evidencia')) {
        $paths = [];
        foreach ($request->file('evidencia') as $file) {
            $path = $file->store('evidencias', 'public');
            $paths[] = $path;
        }
        $validatedData['evidencia'] = json_encode($paths);
    }

    // Agregar los datos del comité antes de crear la queja
    $validatedData['nombre_comite'] = $beneficiario->nombre_comite;
    $validatedData['beneficiario_id'] = $beneficiario->id;

    Quejas::create($validatedData);

    return redirect()->route('buzon-quejas.index')->with('success', 'Queja registrada con éxito.');
}

    /**
     * Mostrar una queja específica.
     */
    public function show($id)
    {
        $queja = Quejas::findOrFail($id);
        return view('ceaa_contraloria.buzon', compact('queja'));
    }
}
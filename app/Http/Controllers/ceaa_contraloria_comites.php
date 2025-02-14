<?php

namespace App\Http\Controllers;

use App\Exports\ComitesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Comites;
use App\Models\Beneficiarios;
use Illuminate\Support\Facades\Storage;

class ceaa_contraloria_Comites extends Controller
{
    public function index()
    {
        $comites = Comites::all() ?? collect([]);
        $beneficiarios = Beneficiarios::all(); // Obtener beneficiarios con clave de comité

        return view('ceaa_contraloria.comites', compact('comites', 'beneficiarios'));
    }

    public function create()
    {
        $beneficiarios = \App\Models\Beneficiarios::all(); // 🔥 Obtener las claves de comité de beneficiarios

        return view('ceaa_contraloria.comites', compact('beneficiarios'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'clave_comite' => 'required|string|max:50|exists:beneficiarios,clave_comite',
            'sexo' => 'required|string',
            'edad' => 'required|integer|min:1',
            'cargo' => 'required|string',
            'correo' => 'required|email',
            'telefono' => 'required|string',
            'usuario' => 'nullable|string|unique:comites,usuario',
            'contrasena' => 'nullable|string|min:8',
            'firma' => 'required|file|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('firma')) {
            // Guardar la imagen en public/storage/comites
            $path = $request->file('firma')->store('comites', 'public');
            $validated['firma'] = $path; // Guardamos solo la ruta relativa en la BD
        }

        Comites::create($validated);

        return redirect()->route('comites.index')->with('success', 'Comité registrado con éxito.');
    }

    public function destroy($id)
    {
        $comite = Comites::findOrFail($id);

        // Eliminar la imagen si existe
        if ($comite->firma) {
            Storage::delete('public/' . $comite->firma);
        }

        $comite->delete();

        return redirect()->route('comites.index')->with('success', 'Integrante eliminado correctamente.');
    }

    public function export()
    {
        return Excel::download(new ComitesExport, 'comites.xlsx');
    }
}

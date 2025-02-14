<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beneficiarios;
use App\Models\Comites;

class ceaa_contraloria_beneficiarios extends Controller
{
    public function index()
    {
        $beneficiarios = Beneficiarios::with('comites')->get();
        return view('ceaa_contraloria.registro', compact('beneficiarios'));
    }


    public function create()
    {
        $beneficiarios = Beneficiarios::all();
        $comites = Comites::all();
        return view('ceaa_contraloria.beneficiarios', compact('beneficiarios', 'comites'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipo_obra' => 'required|string|max:255',
            'apartado' => 'required|string|max:255',
            'fecha_constitucion' => 'required|date',
            'nombre_comite' => 'required|string|max:255',
            'clave_comite' => 'required|string|max:50|unique:beneficiarios,clave_comite',
            'entidad_federativa_comite' => 'required|string|max:100',
            'municipio_comite' => 'required|string|max:100',
            'localidad_comite' => 'required|string|max:100',
            'calle' => 'required|string|max:150',
            'numero' => 'required|string|max:10',
            'colonia' => 'required|string|max:150',
            'codigo_postal' => 'required|string|size:5',
            'nombre_beneficio' => 'required|string|max:255',
            'tipo_beneficio' => 'required|string|max:100',
            'numero_hombres' => 'required|integer|min:0',
            'numero_mujeres' => 'required|integer|min:0',
            'comentarios' => 'required|string',
            'presupuesto' => 'required|numeric|min:0',
            'fecha_inicial' => 'required|date',
            'fecha_terminacion' => 'required|date',
            'nombre_empresa' => 'required|string|max:255',
            'nombre_supervisor' => 'required|string|max:255',
            'nombre_promotor' => 'required|string|max:255',
        ]);

        Beneficiarios::create($validated);
        return redirect()->route('comites.index')->with('success', 'Beneficiario guardado con éxito.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tipo_obra' => 'required|string|max:255',
            'apartado' => 'required|string|max:255',
            'fecha_constitucion' => 'required|date',
            'nombre_comite' => 'required|string|max:255',
            'clave_comite' => 'required|string|max:50|unique:beneficiarios,clave_comite,' . $id,
            'entidad_federativa_comite' => 'required|string|max:100',
            'municipio_comite' => 'required|string|max:100',
            'localidad_comite' => 'required|string|max:100',
            'calle' => 'required|string|max:150',
            'numero' => 'required|string|max:10',
            'colonia' => 'required|string|max:150',
            'codigo_postal' => 'required|string|size:5',
            'nombre_beneficio' => 'required|string|max:255',
            'tipo_beneficio' => 'required|string|max:100',
            'numero_hombres' => 'required|integer|min:0',
            'numero_mujeres' => 'required|integer|min:0',
            'comentarios' => 'required|string',
            'presupuesto' => 'required|numeric|min:0',
            'fecha_inicial' => 'required|date',
            'fecha_terminacion' => 'required|date',
            'nombre_empresa' => 'required|string|max:255',
            'nombre_supervisor' => 'required|string|max:255',
            'nombre_promotor' => 'required|string|max:255',
        ]);

        $beneficiario = Beneficiarios::findOrFail($id);
        $beneficiario->update($validated);

        return redirect()->route('registro')->with('success', 'Beneficiario actualizado con éxito.');
    }

    public function destroy($id)
    {
        $beneficiario = Beneficiarios::findOrFail($id);
        $beneficiario->delete();

        return redirect()->route('beneficiarios.index')->with('success', 'Beneficiario eliminado con éxito.');
    }

    public function show($id)
    {
        $beneficiario = Beneficiarios::with('comite')->findOrFail($id);
        return view('ceaa_contraloria.beneficiarios', compact('beneficiario'));
    }

    public function edit($id)
    {
        $beneficiario = Beneficiarios::findOrFail($id);
        return view('ceaa_contraloria.beneficiarios', compact('beneficiario'));
    }

    // Función para exportar el Excel
    public function exportExcel()
    {
        return Excel::download(new BeneficiariosExport, 'Beneficiarios.xlsx');
    }
}

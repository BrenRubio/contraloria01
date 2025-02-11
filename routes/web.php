<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ceaa_contraloria_beneficiarios;
use App\Http\Controllers\ceaa_contraloria_Comites;
use App\Http\Controllers\ceaa_contraloria_documentacion;
use App\Http\Controllers\ceaa_contraloria_quejas;
use App\Http\Controllers\ceaa_contraloria_segComite;

// Ruta principal con el menú desplegable
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Ruta para la vista de registro (usando el controlador para cargar los beneficiarios)
Route::get('/registro', [ceaa_contraloria_beneficiarios::class, 'index'])->name('registro');

// Ruta para las operaciones de beneficiarios
Route::resource('beneficiarios', ceaa_contraloria_beneficiarios::class);

// Ruta para las operaciones de comités
Route::resource('comites', ceaa_contraloria_Comites::class)->only(['index', 'store', 'destroy']);

// Rutas para las operaciones de documentación
Route::resource('documentacion', ceaa_contraloria_documentacion::class)->only(['index', 'store', 'destroy']);

// Ruta para el buzón de quejas
Route::resource('buzon-quejas', ceaa_contraloria_quejas::class)->only(['index', 'store', 'create', 'show']);

// Ruta de recursos para manejar las operaciones de seguimiento del comité
Route::resource('segComite', ceaa_contraloria_segComite::class)->except(['show']);

// Rutas adicionales desde el menú
Route::view('/seguimiento-Obra', 'ceaa_contraloria.seguimientoObra')->name('seguimiento-Obra');
Route::view('/seguimiento-obra', 'ceaa_contraloria.seguimientoObra')->name('progreso-obra');

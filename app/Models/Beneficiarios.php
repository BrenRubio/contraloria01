<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiarios extends Model
{
    use HasFactory;

    protected $table = 'beneficiarios';

    protected $fillable = [
        'tipo_obra',
        'apartado',
        'fecha_constitucion',
        'nombre_comite',
        'clave_comite',
        'entidad_federativa_comite',
        'municipio_comite',
        'localidad_comite',
        'calle',
        'numero',
        'colonia',
        'codigo_postal',
        'nombre_beneficio',
        'tipo_beneficio',
        'numero_hombres',
        'numero_mujeres',
        'comentarios',
        'presupuesto',
        'fecha_inicial',
        'fecha_terminacion',
        'nombre_empresa',
        'nombre_supervisor',
        'nombre_promotor',
    ];

    // 🔥 Relación con la tabla Comites
    public function comites()
    {
        return $this->hasMany(Comites::class, 'clave_comite', 'clave_comite');
    }

    // 🔥 Relación correcta con los integrantes del comité
    public function integrantes()
    {
        return $this->hasMany(Comites::class, 'clave_comite', 'clave_comite');
    }
}

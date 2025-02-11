<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comites extends Model
{
    use HasFactory;

    protected $table = 'ceaa_contraloria_comites';

    protected $fillable = [
        'nombre',
        'sexo',
        'edad',
        'cargo',
        'correo',
        'telefono',
        'usuario',
        'contrasena',
        'firma',
        'clave_comite'
    ];

    public function beneficiario()
    {
        return $this->belongsTo(Beneficiarios::class, 'clave_comite', 'clave_comite');
    }

    public function integrantes()
    {
        return $this->hasMany(Beneficiarios::class, 'clave_comite', 'clave_comite');
    }
}

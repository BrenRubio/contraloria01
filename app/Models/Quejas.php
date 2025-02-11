<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quejas extends Model
{
    use HasFactory;

    protected $table = 'ceaa_contraloria_quejas';

    protected $fillable = [
        'asunto',
        'nombre_opcional',
        'nombre_reportado', // 🔥 Asegurar que esté aquí
        'beneficiario_id',
        'motivo',
        'clave_comite',
        'nombre_comite',
        'evidencia',
    ];
 
    public function beneficiario()
    {
        return $this->belongsTo(Beneficiarios::class, 'beneficiario_id');
    }
}
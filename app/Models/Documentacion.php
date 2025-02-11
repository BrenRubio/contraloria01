<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentacion extends Model
{
    use HasFactory;

    protected $table = 'ceaa_contraloria_documentacion';

    protected $fillable = [
        'beneficiario_id', // 🔥 Se relaciona con beneficiarios, no con comites
        'descripcion',
        'tipo',
        'archivo',
    ];

    // 🔥 Relación con Beneficiarios
    public function beneficiario()
    {
        return $this->belongsTo(Beneficiarios::class, 'beneficiario_id', 'id');
    }
}
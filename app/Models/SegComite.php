<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SegComite extends Model
{
    use HasFactory;

    protected $table = 'ceaa_contraloria_seguimiento';

    protected $fillable = ['nombre_visita', 'documento'];
}
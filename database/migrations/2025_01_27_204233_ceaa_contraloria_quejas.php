<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ceaa_contraloria_quejas', function (Blueprint $table) {
            $table->id();
            $table->string('asunto');
            $table->string('nombre_opcional')->nullable();
            $table->string('nombre_reportado'); // 🔥 Agregar esta línea
            $table->foreignId('beneficiario_id')->constrained('beneficiarios')->onDelete('cascade');
            $table->string('nombre_comite');
            $table->string('clave_comite');
            $table->text('motivo');
            $table->text('evidencia')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ceaa_contraloria_quejas');
    }
};
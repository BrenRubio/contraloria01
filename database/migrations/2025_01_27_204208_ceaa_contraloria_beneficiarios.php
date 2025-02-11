<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beneficiarios', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_obra')->nullable();
            $table->string('apartado')->nullable();
            $table->date('fecha_constitucion')->nullable();
            $table->string('nombre_comite')->nullable();
            $table->string('clave_comite')->unique(); // 🔥 Clave única del comité para relación
            $table->string('entidad_federativa_comite')->nullable();
            $table->string('municipio_comite')->nullable();
            $table->string('localidad_comite')->nullable();
            $table->string('calle')->nullable();
            $table->string('numero')->nullable();
            $table->string('colonia')->nullable();
            $table->string('codigo_postal')->nullable();
            $table->string('nombre_beneficio')->nullable();
            $table->string('tipo_beneficio')->nullable();
            $table->integer('numero_hombres')->nullable();
            $table->integer('numero_mujeres')->nullable();
            $table->text('comentarios')->nullable();
            $table->decimal('presupuesto', 15, 2)->nullable();
            $table->date('fecha_inicial')->nullable();
            $table->date('fecha_terminacion')->nullable();
            $table->string('nombre_empresa')->nullable();
            $table->string('nombre_supervisor')->nullable();
            $table->string('nombre_promotor')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beneficiarios');
    }
};

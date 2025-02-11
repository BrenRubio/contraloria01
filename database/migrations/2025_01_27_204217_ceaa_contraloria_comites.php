<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ceaa_contraloria_comites', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('sexo');
            $table->integer('edad');
            $table->string('cargo');
            $table->string('correo')->unique();
            $table->string('telefono');
            $table->string('usuario')->nullable();
            $table->string('contrasena')->nullable();
            $table->string('firma')->nullable();
            $table->string('clave_comite'); // 🔥 Relación con beneficiarios
            $table->timestamps();

            // 🔥 Establecer la clave foránea
            $table->foreign('clave_comite')->references('clave_comite')->on('beneficiarios')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ceaa_contraloria_comites');
    }
};

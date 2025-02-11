<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('ceaa_contraloria_documentacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('beneficiario_id'); // 🔥 Relación con beneficiarios
            $table->text('descripcion')->nullable();
            $table->string('tipo')->default('Plano');
            $table->string('archivo');
            $table->timestamps();

            // 🔥 Clave foránea correcta hacia beneficiarios
            $table->foreign('beneficiario_id')
                ->references('id')->on('beneficiarios')
                ->onDelete('cascade'); // Borra los documentos si el beneficiario se elimina
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ceaa_contraloria_documentacion');
    }
};

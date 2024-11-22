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
        Schema::create('egresados', function (Blueprint $table) {
            $table->id();
            $table->string('numero_identificacion');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('programa_academico');
            $table->date('fecha_inicio_pregrado');
            $table->date('fecha_fin_pregrado');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Define la clave foránea automáticamente
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egresados');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ofertas_laborales', function (Blueprint $table) {
            $table->id();
            $table->string('cargo');
            $table->text('descripcion');
            $table->text('requisitos');
            $table->string('nombre_empresa');
            $table->string('contacto_empresa');
            $table->string('correo_empresa');
            $table->string('ciudad_empresa');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con el usuario que publica
            $table->string('estado')->default('activo'); // Agregando el campo estado
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ofertas_laborales');
    }
};

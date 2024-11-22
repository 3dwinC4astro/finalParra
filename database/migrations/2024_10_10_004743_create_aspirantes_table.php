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
    Schema::create('aspirantes', function (Blueprint $table) {
        $table->id();
        $table->string('cedula')->unique();
        $table->string('nombres');
        $table->string('apellidos');
        $table->string('programa');
        $table->string('celular');
        $table->string('correo')->unique();
        $table->date('fecha_nacimiento');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('aspirantes');
}

};

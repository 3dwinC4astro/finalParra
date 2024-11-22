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
        Schema::create('info_laborals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')  // Usamos user_id en lugar de users.id
                  ->constrained('users')  // Relacionamos la clave foránea con la tabla users
                  ->onDelete('cascade'); // Al eliminar un usuario, también se eliminan sus registros laborales
            $table->string('nombre_empresa');
            $table->string('cargo');
            $table->date('fecha_inicio');
            $table->date('fecha_finalizacion')->nullable();
            $table->string('nombre_jefe_inmediato');
            $table->string('detalles_contacto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('info_laborals'); // Cambiar 'info_laboral' a 'info_laborals'
    }
};

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;  // Usar User como base para autenticación

class Egresado extends Authenticatable
{
    use HasFactory;

    // Definir la tabla si es necesario (solo si el nombre de la tabla no es 'egresados')
    protected $table = 'egresados'; // Si la tabla no se llama 'egresados'

    // Definir los campos que se pueden asignar de manera masiva
    protected $fillable = [
        'numero_identificacion',
        'nombres',
        'direccion',
        'telefono',
        'correo_electronico',
        'password',
        'programa_academico',
        'fecha_inicio_pregrado',
        'fecha_fin_pregrado',
        'estado',
        'user_id', // Asegúrate de que este campo exista en la tabla
    ];

    /**
     * Relación con el modelo User.
     * Un egresado pertenece a un usuario (relación inversa).
     */
    public function user()
    {
        return $this->belongsTo(User::class); // Relación con el modelo User
    }

   
}

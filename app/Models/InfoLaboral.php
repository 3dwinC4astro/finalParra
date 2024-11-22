<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoLaboral extends Model
{
    use HasFactory;

    // Definir la relación con la tabla users (muchos a uno)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Resto de las configuraciones del modelo
    protected $fillable = [
        'user_id',
        'nombre_empresa',
        'cargo',
        'fecha_inicio',
        'fecha_finalizacion',
        'nombre_jefe_inmediato',
        'detalles_contacto',
    ];
}

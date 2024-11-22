<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfertaLaboral extends Model
{
    use HasFactory;

    protected $table = 'ofertas_laborales';

    // Campos que pueden ser llenados masivamente
    protected $fillable = [
        'cargo',
        'descripcion',
        'requisitos',
        'nombre_empresa',
        'contacto_empresa',
        'correo_empresa',
        'ciudad_empresa',
        'user_id',
    ];

    // Relación con el usuario que publicó la oferta laboral
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

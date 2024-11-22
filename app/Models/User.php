<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Importa la trait HasFactory
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, HasRoles; // Asegúrate de incluir HasFactory

    protected $fillable = ['id', 'imagen', 'name', 'email', 'password', 'estado'];

    // Relación con InfoLaboral
    public function infoLaborals()
    {
        return $this->hasMany(InfoLaboral::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table = "personas";
    protected $primaryKey = "id_persona";

    protected $fillable = [
        'documento', 'tipo_documento', 'nombre', 'primer_apellido',
        'segundo_apellido', 'correo', 'correo_sena', 'celular_uno',
        'celular_dos', 'firma', 'estado', 'id_municipio'
    ];
}

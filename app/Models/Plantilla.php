<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plantilla extends Model
{
    use HasFactory;

    protected $primaryKey = "id_plantilla";
    protected $fillable = [
        'nombre', 'descripcion', 'fecha_creacion', 'fecha_finalizacion', 'ciudad', 'id_proceso'
    ];
    public $timestamps = false;
}

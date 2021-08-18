<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;

    protected $primaryKey = "id_pregunta";

    protected $fillable = [ 'pregunta_evidencia', 'pregunta_actividad', 'estado' ];
    
}

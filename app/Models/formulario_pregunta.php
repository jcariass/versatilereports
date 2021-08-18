<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class formulario_pregunta extends Model
{
    use HasFactory;

    protected $table = "formulario_pregunta";
    
    protected $primaryKey = "id_formulario_pregunta";

    protected $fillable = [ 'id_obligacion', 'id_pregunta', 'id_formulario' ];

    public $timestamps = false;
    
}

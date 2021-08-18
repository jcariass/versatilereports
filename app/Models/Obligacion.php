<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obligacion extends Model
{
    use HasFactory;

    protected $table = "obligaciones";

    protected $primaryKey = "id_obligacion";

    protected $fillable = [
        'detalle', 'id_proceso', 'fecha_creacion', 'fecha_vencimiento'
    ];

    public $timestamps = false;
    
}

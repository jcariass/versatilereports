<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parrafo extends Model
{
    use HasFactory;

    protected $primaryKey = "id_parrafo";
    public $timestamps = false;

    protected $fillable = [
        'texto', 'numero_parrafo', 'id_plantilla', 'estado'
    ];
}

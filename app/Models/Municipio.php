<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_municipio';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'id_departamento'
    ];
}

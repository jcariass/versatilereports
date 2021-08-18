<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permiso_rol extends Model
{
    use HasFactory;

    protected $table = "permiso_rol";
    protected $primaryKey = "id_permiso_rol";
    protected $fillable = [
        'id_rol', 'id_permiso'
    ];
    public $timestamps = false;
}

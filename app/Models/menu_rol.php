<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu_rol extends Model
{
    use HasFactory;

    protected $table = "menu_rol";
    protected $primaryKey = "id_menu_rol";

    protected $fillable = [
        'id_rol', 'id_menu'
    ];
    public $timestamps = false;
}

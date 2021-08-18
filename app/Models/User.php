<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = "usuarios";
    protected $primaryKey = "id_usuario";

    protected $fillable = [
        'tipo_documento',
        'documento',
        'password',
        'estado',
        'email',
        'id_rol',
        'id_persona'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}

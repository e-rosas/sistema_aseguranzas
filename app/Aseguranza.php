<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aseguranza extends Model
{
    public $timestamps = false;
    public $fillable = [
        'nombre',
        'domicilio',
        'ciudad',
        'estado',
        'codigo_postal',
        'telefono',
        'correo_e',
        'clave',
    ];

    public static $rules = [
        'nombre' => 'required|min:10|max:255',
        'domicilio' => 'max:255',
        'ciudad' => 'max:255',
        'estado' => 'max:255',
        'codigo_postal' => 'digits:5',
        'telefono' => 'required|max:255',
        'correo_e' => 'email',
        'clave' => 'max:255',
    ];
}

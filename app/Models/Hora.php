<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hora extends Model
{
    protected $table = 'horas';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    protected $fillable = [
        'hora_inicio', 
        'hora_fin',
        'turno', 
        'estado'
    ];

    protected $casts = [
        'hora_inicio' => 'datetime:H:i',
        'hora_fin' => 'datetime:H:i',
    ];

    public static function validarRango($hora_inicio, $hora_fin): bool
    {
        return strtotime($hora_inicio) < strtotime($hora_fin);
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    protected $fillable = [
        'carnet', 
        'nombre', 
        'sexo', 
        'telefono', 
        'direccion', 
        'fecha_ingreso'
    ];

    public function getSexoAttribute($value)
    {
        return trim($value);
    }

    public function docente()
    {
        return $this->hasOne(Docente::class);
    }

    public function administrativo()
    {
        return $this->hasOne(Administrativo::class);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'persona_id'); 
    }

}

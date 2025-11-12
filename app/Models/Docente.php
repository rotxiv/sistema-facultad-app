<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $table = 'docentes';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    protected $fillable = [
        'persona_id', 
        'codigo', 
        'correo', 
        'password',
        'carga_horaria',  
        'estado'
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id');
    }

    public function horarios()
    {
        return $this->belongsToMany(Horario::class, 'horario_docentes', 'docente_id', 'horario_id');
    }

}

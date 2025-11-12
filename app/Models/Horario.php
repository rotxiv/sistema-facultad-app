<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = 'horarios';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    protected $fillable = [
        'hora_id', 
        'dia_id',
        'aula_id',
        'asignatura_id',
        'semestre_id',
        'observacion',
    ];

   // Relaciones
    public function administrativo()
    {
        return $this->belongsTo(Administrativo::class);
    }

    public function hora()
    {
        return $this->belongsTo(Hora::class, 'hora_id');
    }

    public function dia()
    {
        return $this->belongsTo(Dia::class);
    }

    public function aula()
    {
        return $this->belongsTo(Aula::class);
    }

    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class);
    }

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    public function docentes()
    {
        return $this->belongsToMany(Docente::class, 'horario_docentes', 'horario_id', 'docente_id');
    }


    public static function conflictoAula($aula_id, $dia_id, $semestre_id, $hora_id)
    {
        $horaActual = Hora::find($hora_id);

        return self::where('aula_id', $aula_id)
            ->where('dia_id', $dia_id)
            ->where('semestre_id', $semestre_id)
            ->whereHas('hora', function ($query) use ($horaActual) {
                $query->where('hora_inicio', '<', $horaActual->hora_fin)
                    ->where('hora_fin', '>', $horaActual->hora_inicio);
            })
            ->exists();
    }

    public static function conflictoDocente($docente_id, $dia_id, $semestre_id, $hora_id)
    {
        $horaActual = Hora::find($hora_id);

        return self::where('dia_id', $dia_id)
            ->where('semestre_id', $semestre_id)
            ->whereHas('hora', function ($query) use ($horaActual) {
                $query->where('hora_inicio', '<', $horaActual->hora_fin)
                    ->where('hora_fin', '>', $horaActual->hora_inicio);
            })
            ->whereHas('docentes', function ($q) use ($docente_id) {
                $q->where('docente_id', $docente_id);
            })
            ->exists();
    }

    public function asignarDocenteAutomatico($docente_id)
    {
        if (!self::conflictoDocente(
            $docente_id,
            $this->dia_id,
            $this->semestre_id,
            $this->hora_id
        )) {
            $this->docentes()->attach($docente_id);
            return true;
        }
        return false;
    }

}

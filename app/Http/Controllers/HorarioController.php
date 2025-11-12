<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\GrupoAsignatura;
use App\Models\Semestre;
use App\Models\Horario;
use App\Models\Docente;
use App\Models\Aula;
use App\Models\Hora;
use App\Models\Dia;


class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $horarios = Horario::with(['aula', 'dia', 'asignatura', 'hora', 'semestre', 'docentes'])
            ->where('estado', true)
            ->get();

        return view('application.horario.index', compact('horarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'codigo' => 'required|exists:docentes,codigo'
        ]);
        
        $codigo = $request->codigo;

        $semestre = Semestre::orderBy('id', 'desc')->first();

        // Obtener los datos del docente (id, codigo, carnet, nombre)
        $docente = Docente::with(['persona:id,carnet,nombre'])
            ->where('estado', true)
            ->where( 'codigo', $codigo)
            ->select('id', 'codigo', 'persona_id')
            ->first();

        // Filtrar  asignaturas del docente solo del semestre actual
        $items = GrupoAsignatura::where('docente_id', $docente->id)
            ->where('semestre_id', $semestre->id)
            ->with(['asignatura', 'grupo'])
            ->get();

        $asignaciones = $items->map(function ($item) {
            return [
                'asignatura' => $item->asignatura,
                'grupo' => $item->grupo,
            ];
        });

        $dias = Dia::where('estado', true)->get();

        $aulas = Aula::where('estado', true)->get();

        $horas = Hora::where('estado', true)->get();

        return view(
            'application.horario.create', 
            compact(
                'semestre', 'docente', 'asignaciones', 'dias', 'aulas', 'horas'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'hora_id' => 'required|exists:horas,id',
            'dia_id' => 'required|exists:dias,id',
            'dia_id.*' => 'exists:dias,id',
            'aula_id' => 'required|exists:aulas,id',
            'asignatura_id' => 'required|exists:asignaturas,id',
            'semestre_id' => 'required|exists:semestres,id',
            'docente_id' => 'nullable|exists:docentes,id',
            'observacion' => 'nullable|string'
        ]);

        $errores = [];

        foreach ($validated['dia_id'] as $dia_id) {
            // Validar conflicto en aula
            if (Horario::conflictoAula(
                $validated['aula_id'],
                $dia_id,
                $validated['semestre_id'],
                $validated['hora_id']
            )) {
                $errores[] = "El aula ya está ocupada el día ID {$dia_id}.";
                continue;
            }

            // Validar conflicto docente
            if ($validated['docente_id'] && Horario::conflictoDocente(
                $validated['docente_id'],
                $dia_id,    
                $validated['semestre_id'],
                $validated['hora_id']
            )) {
                $errores[] = "El docente ya tiene clase el día ID {$dia_id}.";
                continue;
            }

            // Crear horario
            $horario = Horario::create([
                'hora_id' => $validated['hora_id'],
                'dia_id' => $dia_id,
                'aula_id' => $validated['aula_id'],
                'asignatura_id' => $validated['asignatura_id'],
                'semestre_id' => $validated['semestre_id'],
                'observacion' => $validated['observacion'] ?? null,
            ]);

            // Asignar docente
            if ($validated['docente_id']) {
                $horario->docentes()->attach($validated['docente_id']);
            }
        }

        if (count($errores)) {
            return back()->withErrors(['conflictos' => $errores]);
        }

        // uso de la bitacora
        registrar_bitacora(
            "Se creo los horarios para el docente {$request->docente_id}"
        );

        return redirect()->route('horarios.index')
            ->with('success', 'Horarios creados correctamente.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Horario $horario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Horario $horario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Horario $horario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Horario $horario)
    {
        //
    }
}


        /* // Validar conflicto en aula
        if (Horario::conflictoAula(
            $validated['aula_id'],
            $validated['dia_id'],
            $validated['semestre_id'],
            $validated['hora_id']
        )) {
            return back()->withErrors(
                ['conflicto' => 'El aula ya está ocupada en este horario.']
            );
        }

        if ($validated['docente_id'] && Horario::conflictoDocente(
            $validated['docente_id'],
            $validated['dia_id'],
            $validated['semestre_id'],
            $validated['hora_id']
        )) {
            return back()->withErrors([
                'conflicto' => 'El docente ya tiene una clase en este horario.'
            ]);
        }

        // Crear el horario
        $horario = Horario::create([
            'hora_id' => $validated['hora_id'],
            'dia_id' => $validated['dia_id'],
            'aula_id' => $validated['aula_id'],
            'asignatura_id' => $validated['asignatura_id'],
            'semestre_id' => $validated['semestre_id'],
            'observacion' => $validated['observacion'] ?? null,
        ]);

        // Asignar docente si se envió
        if ($validated['docente_id']) {
            $horario->docentes()->attach($validated['docente_id']);
        } */
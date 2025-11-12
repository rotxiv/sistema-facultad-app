<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aulas = Aula::where('estado', true)->get();

        return view('application.aula.index', compact('aulas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'numero_aula'=> 'required|integer|min:10|max:50',
            'tipo_aula' => 'required|string|max:15'
        ]);

        // Crear el aula
        $aula_temp = Aula::create([
            'numero_aula' => $request->numero_aula,
            'tipo_aula' => $request->tipo_aula
        ]);

        // obtener el aula creado
        $aula = Aula::where('id', $aula_temp->id)
            ->where('estado', true)
            ->first();

        // uso de la bitacora
        registrar_bitacora(
            "Se añadio el aula número {$aula->numero_aula} de tipo {$aula->tipo_aula}"
        );

        return redirect()->route('aulas.index')
            ->with('success', 'Número de aula agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Aula $aula)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aula $aula)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'tipo_aula' => 'required|string|max:15'
        ]);

        $aula = Aula::where('id', $id)
            ->where('estado', true)
            ->first();

        $aula_ant = $aula->tipo_aula;

        // Actualizar el numero de aula
        $aula->update([
            'tipo_aula' => $request->tipo_aula
        ]);

        // uso de la bitacora
        registrar_bitacora(
            "Se actualizo el aula número {$aula->numero_aula} de tipo {$aula_ant} a {$aula->tipo_aula}"
        );

        return redirect()->route('aulas.index')
            ->with('success', 'Numero de aula actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $aula = Aula::where('id', $id)
            ->where('estado', true)
            ->first();

        if (!$aula) {
            return redirect()->route('aulas.index')
                ->with('error', 'Número de aula no encontrado.');
        }

        $aula->estado = false;
        
        $aula->save();

        registrar_bitacora(
            "Se elimino el aula número {$aula->numero_aula} de tipo {$aula->tipo_aula}"
        );

        return redirect()->route('aulas.index')
            ->with('success', 'Número de aula eliminado correctamente.');
    }

    public function reactivate($id)
    {
        $aula = Aula::where('id', $id)
            ->where('estado', false)
            ->first();

        if (!$aula) {
            return redirect()->route('aulas.index')
                ->with('error', 'Número de aula no encontrado.');
        }

        $aula->estado = true;
        
        $aula->save();

        registrar_bitacora(
            "Se reactivo el aula número {$aula->numero_aula} de tipo {$aula->tipo_aula}"
        );
        
        return redirect()->route('aulas.index')
            ->with('success', 'Número de aula agregado correctamente.');
    }

    public function deletedIndex()
    {
        // Obtenemos todos los roles retirados (estado = false)
        $aulas = Aula::where('estado', false)->get();

        return view(
            'application.aula.deletedIndex', compact('aulas')
        );
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grupos = Grupo::where('estado', true)->get();

        return view('application.grupo.index', compact('grupos'));
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
            'descripcion'=> 'required|string|max:5'
        ]);

        // Crear el rol
        $grupo = Grupo::create([
            'descripcion' => $request->descripcion
        ]);

        registrar_bitacora(
            "Se añadio un nuevo grupo : {$grupo->descripcion}"
        );

        return redirect()->route('grupos.index')
            ->with('success', 'Grupo agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        /* $grupo = Grupo::where('estado', true)->find($id);

        return view('application.grupo.show', compact('grupo')); */
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        /* $grupo = Grupo::where('id', $id)
            ->where('estado', true)
            ->first();
        
        return view('application.grupo.edit', compact('grupo')); */
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'descripcion'=> 'required|string|max:5'
        ]);

        $grupo = Grupo::where('id', $id)
            ->where('estado', true)
            ->first();

        $grupo_ant = $grupo->descripcion;

        // Crear el rol
        $grupo->update([
            'descripcion' => $request->descripcion
        ]);

        registrar_bitacora(
            "Se actualizo el grupo {$grupo->descripcion} a {$grupo_ant}"
        );

        return redirect()->route('grupos.index')
            ->with('success', 'Grupo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $grupo = Grupo::where('id', $id)
            ->where('estado', true)
            ->first();

        if (!$grupo) {
            return redirect()->route('grupos.index')
                ->with('error', 'Grupo no encontrado.');
        }

        $grupo->estado = false;
        
        $grupo->save();

        registrar_bitacora(
            "Se retiro el grupo : {$grupo->descripcion}"
        );

        return redirect()->route('grupos.index')
            ->with('success', 'Grupo eliminado correctamente.');
    }

    public function reactivate($id)
    {
        $grupo = Grupo::where('id', $id)
            ->where('estado', false)
            ->first();

        if (!$grupo) {
            return redirect()->route('grupos.index')
                ->with('error', 'Grupo no encontrado.');
        }

        $grupo->estado = true;
        
        $grupo->save();

        registrar_bitacora(
            "Se reactivo el grupo : {$grupo->descripcion}"
        );

        return redirect()->route('grupos.index')
            ->with('success', 'Grupo agregado correctamente.');
    }

    public function deletedIndex()
    {
        // Obtenemos todos los roles retirados (estado = false)
        $grupos = Grupo::where('estado', false)->get();

        return view(
            'application.grupo.deletedIndex', compact('grupos')
        );
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Dia;
use Illuminate\Http\Request;

class DiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dias = Dia::where('estado', true)->get();

        return view('application.dia.index', compact('dias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //return view('application.dia.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'descripcion'=> 'required|string|max:10'
        ]);

        // Crear el rol
        $dia_temp = Dia::create([
            'descripcion' => $request->descripcion
        ]);

        // obtener el rol creado
        $dia = Dia::where('id', $dia_temp->id)
            ->where('estado', true)
            ->first();

        registrar_bitacora(
            "Se añadio un nuevo dia : {$dia->descripcion}"
        );
        return redirect()->route('dias.index')
            ->with('success', 'Dia agregado correctamente.');
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
        /* $dia = Dia::where('id', $id)
            ->where('estado', true)
            ->first();
        
        return view('application.dia.edit', compact('dia')); */
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'descripcion'=> 'required|string|max:10'
        ]);

        $dia = Dia::where('id', $id)
            ->where('estado', true)
            ->first();

        // Actualizar los datos
        $dia->update([
            'descripcion' => $request->descripcion
        ]);

        registrar_bitacora(
            "Se actualizo el dia : {$dia->descripcion}"
        );

        return redirect()->route('dias.index')
            ->with('success', 'Dia actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dia = Dia::where('id', $id)
            ->where('estado', true)
            ->first();

        if (!$dia) {
            return redirect()->route('dias.index')
                ->with('error', 'Dia no encontrado.');
        }

        $dia->estado = false;
        
        $dia->save();

        registrar_bitacora(
            "Se retiro el dia : {$dia->descripcion}"
        );

        return redirect()->route('dias.index')
            ->with('success', 'Dia eliminado correctamente.');
    }

    public function reactivate($id)
    {
        $dia = Dia::where('id', $id)
            ->where('estado', false)
            ->first();

        if (!$dia) {
            return redirect()->route('dias.index')
                ->with('error', 'Dia no encontrado.');
        }

        $dia->estado = true;
        
        $dia->save();

        registrar_bitacora(
            "Se reingreso el dia : {$dia->descripcion}"
        );
        
        return redirect()->route('dias.index')
            ->with('success', 'Dia agregado correctamente.');
    }

    public function deletedIndex()
    {
        // Obtenemos todos los roles retirados (estado = false)
        $dias = Dia::where('estado', false)->get();

        return view(
            'application.dia.deletedIndex', compact('dias')
        );
    }
}

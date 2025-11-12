<?php

namespace App\Http\Controllers;

use App\Models\Hora;
use Illuminate\Http\Request;

class HoraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $horas = Hora::where('estado', true)->get();

        return view('application.hora.index', compact('horas'));
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
        $request->validate([
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'turno' => 'required|string|in:Mañana,Tarde,Noche'
        ]);
        
        // Guardar si todo está bien
        $hora = Hora::create([
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'turno' => $request->turno,
        ]);

        // uso de la bitacora
        registrar_bitacora(
            "Agregado nueva hora de clase : {$hora->hora_inicio} hasta: {$hora->hora_fin}"
        );

        return redirect()->back()->with('success', 'Hora registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hora $hora)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hora $hora)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hora $hora)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hora = Hora::where('id', $id)
            ->where('estado', true)
            ->first();

        if (!$hora) {
            return redirect()->route('horas.index')
                ->with('error', 'Hora no encontrado.');
        }

        $hora->estado = false;
        
        $hora->save();

        registrar_bitacora(
            "Se retiro la hora de clase de : {$hora->hira_inicio} a {$hora->hora_fin}" 
        );

        return redirect()->route('horas.index')
            ->with('mensaje', 'hora de clase eliminado correctamente.');
    }
}

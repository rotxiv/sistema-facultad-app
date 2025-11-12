<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Rol::where('estado', true)->get();

        return view('application.rol.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //return view('application.rol.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:25',
            'descripcion'=> 'required|string|max:100'
        ]);

        // Crear el rol
        $rol_temp = Rol::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion
        ]);

        // obtener el rol creado
        $rol = Rol::where('estado', true)
            ->find($rol_temp->id);

        registrar_bitacora(
            "Se añadio un nuevo rol : {$rol->nombre}"
        );

        return redirect()->route('roles.index')
            ->with('success', 'Rol eliminado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        /* $rol = Rol::where('estado', true)->find($id);

        return view('application.rol.show', compact('rol')); */
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        /* $rol = Rol::where('estado', true)->find($id);
        
        return view('application.rol.edit', compact('rol')); */
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:25',
            'descripcion'=> 'required|string|max:100'
        ]);

        $rol = Rol::where('id', $id)
            ->where('estado', true)
            ->first();
        
        // Crear el rol
        $rol->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion
        ]);

        registrar_bitacora(
            "Se actualizo el rol : {$rol->nombre}"
        );

        return redirect()->route('roles.index')
            ->with('success', 'Rol actulizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rol = Rol::where('id', $id)
            ->where('estado', true)
            ->first();

        if (!$rol) {
            return redirect()->route('roles.index')
                ->with('error', 'Rol no encontrado.');
        }

        $rol->estado = false;
        
        $rol->save();

        registrar_bitacora(
            "Se retiro el rol : {$rol->nombre}"
        );

        return redirect()->route('roles.index')
            ->with('success', 'Rol eliminado correctamente.');
    }

    public function reactivate($id)
    {
        $rol = Rol::where('id', $id)
            ->where('estado', false)
            ->first();

        if (!$rol) {
            return redirect()->route('roles.index')
                ->with('error', 'Rol no encontrado.');
        }

        $rol->estado = true;
        
        $rol->save();

        registrar_bitacora(
            "Se reactivo el rol : {$rol->nombre}"
        );
        
        return redirect()->route('roles.index')
            ->with('success', 'Rol agregado correctamente.');
    }

    public function deletedIndex()
    {
        // Obtenemos todos los roles retirados (estado = false)
        $roles = Rol::where('estado', false)->get();

        return view(
            'application.rol.deletedIndex', compact('roles')
        );
    }
}
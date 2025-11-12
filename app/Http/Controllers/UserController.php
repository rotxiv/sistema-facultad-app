<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Rol;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //retorna todos los docentes que estan visibles
        $users = User::where('estado', true)->get();
        
        $roles = Rol::where('estado', true)->get();

        return view('application.user.index', compact('users', 'roles'));
        
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        // Obtener el usuario
        $user = User::where('id', $id)
            ->where('estado', true)
            ->firstOrFail();

        // Validar los datos del formulario
        $request->validate([
            'rol_id'   => 'required|exists:rols,id',
            'name'     => 'required|string|max:50',
            'email'    => 'required|string|email|max:50|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed', // opcional y con confirmación
        ]);

        // Actualizar datos
        $data = [
            'rol_id' => $request->rol_id,
            'name'   => $request->name,
            'email'  => $request->email,
        ];

        // Solo actualizar contraseña si se envió
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        // Registrar en bitácora
        registrar_bitacora("Se actualizó al usuario: {$user->id}");

        return redirect()->route('users.index')
            ->with('mensaje', 'El usuario fue actualizado correctamente.');
    }

    public function destroy($id)
    {
        // Buscar usuario activo
        $user = User::where('id', $id)
            ->where('estado', true)
            ->firstOrFail();

        // Marcar como inactivo
        $user->update([
            'estado' => false,
        ]);

        // Registrar en bitácora
        registrar_bitacora("Se eliminó al usuario: {$user->id}");

        return redirect()->route('users.index')
            ->with('mensaje', 'El usuario fue eliminado correctamente.');
    }

    public function restore($id)
    {
        // Buscar usuario inactivo
        $user = User::where('id', $id)
            ->where('estado', false)
            ->firstOrFail();

        // Restaurar estado
        $user->update([
            'estado' => true,
        ]);

        // Registrar en bitácora
        registrar_bitacora("Se restauró al usuario: {$user->id}");

        return redirect()->route('users.index')
            ->with('mensaje', 'El usuario fue restaurado correctamente.');
    }

}
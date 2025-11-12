<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('web')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            $user = auth()->user();

            registrar_bitacora("El usuario {$user->name} ha iniciado sesión.");

            // si tiene rol definido, redirigir al dashboard correspondiente a ese rol
            switch ($user->rol->nombre) {
                case 'Administrador':
                    return redirect()->route('administrador.dashboard');
                case 'Docente':
                    return redirect()->route('docente.dashboard');
                case 'Estudiante':
                    return redirect()->route('estudiante.dashboard');
            }

        }

        // Si falla la autenticación
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        $user = auth()->user();
        registrar_bitacora("El usuario {$user->name} ha cerrado sesión.");

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

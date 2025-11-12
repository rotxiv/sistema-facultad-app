<?php

use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;

if (!function_exists('registrar_bitacora')) {
    function registrar_bitacora($descripcion)
    {
        $user = Auth::user();

        Bitacora::create([
            'user_id' => $user ? $user->id : null,
            'descripcion' => $descripcion,
            'fecha_hora' => now()->toDateTimeString(),
            'registro' => request()->header('User-Agent') ?? 'Desconocido'
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Rol;
use App\Models\Persona;
use App\Models\Administrativo;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear rol de administrador
        $rolAdmin = Rol::firstOrCreate([
            'nombre' => 'Administrador'
        ], [
            'descripcion' => 'Usuario con acceso completo al sistema'
        ]);

        // Crear persona
        $persona = Persona::firstOrCreate([
            'carnet' => 'ADM001'
        ], [
            'nombre' => 'Administrador del Sistema',
            'sexo' => 'M',
            'telefono' => '70000000',
            'direccion' => 'Oficina Principal',
            'fecha_ingreso' => now()->format('Y-m-d')
        ]);

        // Crear administrativo
        $administrativo = Administrativo::firstOrCreate([
            'codigo' => 'ADM001'
        ], [
            'persona_id' => $persona->id,
            'correo' => 'admin@facultad.edu',
            'estado' => true
        ]);

        // Crear usuario administrador
        User::firstOrCreate([
            'email' => 'admin@facultad.edu'
        ], [
            'persona_id' => $persona->id,
            'rol_id' => $rolAdmin->id,
            'name' => 'Administrador',
            'password' => Hash::make('admin123'),
            
        ]);

        $this->command->info('Usuario administrador creado exitosamente:');
        $this->command->info('Email: admin@facultad.edu');
        $this->command->info('Contraseña: admin123');
        $this->command->info('Código Administrativo: ADM001');
    }
}

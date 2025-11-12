<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'persona_id',   // ignora persona.
        'rol_id',
        'name',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    // app/Models/User.php
    public function dashboardRoute()
    {
        switch ($this->rol->nombre) {
            case 'Administrador':
                return route('administrador.dashboard');
            case 'Docente':
                return route('docente.dashboard');
            case 'Estudiante':
                return route('estudiante.dashboard');
            case 'Coordinador':
                return route('coordinador.dashboard');
            case 'Secretaria':
                return route('secretaria.dashboard');
            default:
                return route('home'); // genérico
        }
    }

    /**
     * Relación con el rol
     */
    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }

    // User.php
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id');
    }

    public function docente()
    {
        return $this->persona->docente ?? null;
    }

    /**
     * Verificar si el usuario es administrador
     */
    public function isAdmin(): bool
    {
        return $this->rol && $this->rol->nombre === 'Administrador';
    }
}

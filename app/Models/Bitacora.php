<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $table = 'bitacoras';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    protected $fillable = [ 
        'user_id', 
        'descripcion',
        'fecha_hora',
        'registro', 
        'visible' 
    ];

    // Relación con User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

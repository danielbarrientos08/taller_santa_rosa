<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Estudiante  extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table      = 'estudiante';
    public $incrementing  = true;
    public $timestamps    = true;
    const CREATED_AT = 'fecha_registro';
    const UPDATED_AT = 'fecha_actualizacion';
    protected $primaryKey = 'estudiante_id';
    protected $guarded = [];


    protected $casts = [
        'fecha_registro' => 'datetime:Y-m-d H:i:s',
        'fecha_actualizacion' => 'datetime:Y-m-d H:i:s',
        'fecha_nacimiento' => 'datetime:Y-m-d',
        'documento' => 'string',
        'codigo_estudiante' => 'string'
    ];

     //establecer el campo a comparar en el attemp auth
     public function getAuthPassword() {
        return $this->documento;
    }
    /**Scopes */
    public function scopeGrado($query,$grado)
    {
        if ($grado!= '')
            return $query->where('grado', $grado);
    }
    public function scopeNivel($query,$nivel)
    {
        if ($nivel!= '')
            return $query->where('nivel', $nivel);
    }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table      = 'usuario';
    protected $primaryKey = 'usuario_id';
    public $incrementing  = true;
    public $timestamps    = false;

    protected $guarded = [];

    protected $hidden = [
        'Password',
    ];

    protected $casts = [
        'fecha_registro' => 'datetime:Y-m-d H:i:s',
        'fecha_actualizacion' => 'datetime:Y-m-d H:i:s'
    ];

    //protected $with = ['Role'];
    //establecer el campo a comparar en el attemp auth
    public function getAuthPassword() {
        return $this->password;
    }

    /** Relaciones */

    /**Scopes */
    public function scopeEstado($query,$status)
    {
        if ($status!= '')
            return $query->where('estado', $status);
    }


}

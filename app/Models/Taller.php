<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taller extends Model
{
    use HasFactory;
    protected $table      = 'taller';
    public $incrementing  = true;
    public $timestamps    = false;
    protected $primaryKey = 'taller_id';
    protected $guarded = [];

    /**Scopes */
    public function scopeCodTaller($query,$value)
    {
        if ($value!= '')
            return $query->where('cod_taller','like', '%'.$value.'%');
    }
    public function scopeNombre($query,$value)
    {
        if ($value!= '')
            return $query->where('nombre','like', '%'.$value.'%');
    }
    public function scopeGrupo($query,$value)
    {
        if ($value!= '')
            return $query->where('grupo', $value);
    }
    public function scopeEstado($query,$value)
    {
        if ($value!= '')
            return $query->where('estado',$value);
    }
}

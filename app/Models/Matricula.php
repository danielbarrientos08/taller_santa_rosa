<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Matricula extends Model
{
    use HasFactory;

    protected $table      = 'matricula';
    public $incrementing  = true;
    public $timestamps    = true;
    const CREATED_AT = 'fecha_registro';
    const UPDATED_AT = 'fecha_actualizacion';
    protected $primaryKey = 'matricula_id';
    protected $guarded = [];
    protected $casts = [
        'fecha_registro' => 'datetime:Y-m-d H:i:s',
        'fecha_actualizacion'   => 'datetime:Y-m-d H:i:s',
    ];

    public function getFechaRegistroAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function getFechaActualizacionAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    protected $with = ['estudiante','taller','periodo'];

    public function estudiante()
    {
        return $this->belongsTo('App\Models\Estudiante', 'estudiante_id', 'estudiante_id');
    }
    public function taller()
    {
        return $this->belongsTo('App\Models\Taller', 'taller_id', 'taller_id');
    }
    public function periodo()
    {
        return $this->belongsTo('App\Models\Periodo', 'periodo_id', 'periodo_id');
    }


     /**Scopes */
     public function scopeGrado($query,$value)
     {
         if ($value!= '')
             return $query->where('grado', $value);
     }
     public function scopeNivel($query,$value)
     {
         if ($value!= '')
             return $query->where('nivel', $value);
     }
     public function scopeSeccion($query,$value)
     {
         if ($value!= '')
            return $query->where('seccion', $value);
     }

     public function scopeTaller($query,$value)
     {
         if ($value!= '')
             return $query->where('taller_id', $value);
     }
     public function scopeCodTaller($query,$value)
     {
         if ($value!= '')
             return $query->where('cod_taller', $value);
     }
     public function scopeDocumentoEstudiante($query,$value)
     {
         if ($value!= '')
             return $query->where('ducumento_estudiante','LIKE', '%'.$value.'%');
     }

}

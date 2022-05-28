<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

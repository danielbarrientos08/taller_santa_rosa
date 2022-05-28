<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matricula;
use App\Models\Periodo;
use App\Models\Estudiante;
use App\Models\Taller;

class MatriculaController extends Controller
{
    public function index()
    {
        return view('web.matricula.index');
    }

    public function listar(Request $request)
    {
        if($request->ajax())
        {
            $periodo = Periodo::where('estado','Activo')->first();
            $talleres = Taller::where('estado','Activo')->get();
            $estudiante = Estudiante::find(\Auth::user()->estudiante_id);
            $matriculas = Matricula::where('estudiante_id',\Auth::user()->estudiante_id)->where('periodo_id',$periodo->periodo_id)->get();

            return response()->json([
                'periodo'=> $periodo,
                'talleres'=> $talleres,
                'estudiante'=> $estudiante,
                'matriculas'=> $matriculas
            ],200);
        }
    }

    public function crear(Request $request )
    {   
        if($request->ajax())
        {
           
            $estudiante = Estudiante::find(\Auth::user()->estudiante_id);
            $periodo = Periodo::where('estado','Activo')->first();

            $matricula   = new Matricula();
            $matricula->taller_id      = $request->taller_id; 
            $matricula->estudiante_id  = $estudiante->estudiante_id; 
            $matricula->ducumento_estudiante   = $estudiante->documento;
            $matricula->dia_semana   = $request->dia_semana; 
            $matricula->periodo_id   = $periodo->periodo_id; 
            $matricula->nivel   = $estudiante->nivel;
            $matricula->grado   = $estudiante->grado;
            $matricula->seccion   = $estudiante->seccion;
            $matricula->save();

            return response()->json([
                'response'=> $matricula
            ],201);
        }
    }

   

    public function eliminar(Request $request,$matricula_id )
    {
        if($request->ajax())
        {
            $user = Matricula::findOrFail($matricula_id);
            $user->delete();

            return response('success',200);
        }
    }
}

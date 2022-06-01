<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matricula;
use App\Models\Periodo;
use App\Models\Taller;

class MatriculaController extends Controller
{
    public function index()
    {
        return view('admin.matricula.index');
    }

    public function listar(Request $request)
    {
        if($request->ajax())
        {

            $periodo = Periodo::where('estado','Activo')->first();
            $talleres = Taller::where('estado','Activo')->where('vacantes','>',0)->orderBy('nombre')->get();
            $matriculas = Matricula::where('periodo_id',$periodo->periodo_id)
                            ->taller($request->taller_id)
                            ->codTaller($request->cod_taller)
                            ->documentoEstudiante($request->documento_estudiante)
                            ->nivel($request->nivel)
                            ->grado($request->grado)
                            ->seccion($request->seccion)
                            ->paginate(20);

            return response()->json([
                'talleres'=> $talleres,
                'matriculas'=> $matriculas
            ],200);
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
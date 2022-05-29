<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matricula;
use App\Models\Periodo;
use App\Models\Estudiante;
use App\Models\Taller;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;

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
            $talleres = Taller::where('estado','Activo')->where('vacantes','>',0)->get();
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

    public function vacantes(Request $request,$taller_id)
    {
        $vancatesDisponibles = $this->vacantesDisponibles($taller_id);

        return response()->json([
            'vacantesDisponibles'=> $vancatesDisponibles
        ],200);
    }

    private function vacantesDisponibles($taller_id){

        $periodo = Periodo::where('estado','Activo')->first();
        $taller = Taller::findOrFail($taller_id);
        $matriculas = Matricula::where('taller_id',$taller_id)
                        ->where('nivel',\Auth::user()->nivel)
                        ->where('periodo_id',$periodo->periodo_id)->get()->count();

        $vancatesDisponibles = (int) $taller->vacantes - (int)$matriculas;

        return $vancatesDisponibles;
    }

    public function crear(Request $request )
    {
        if($request->ajax())
        {
            try {
                DB::beginTransaction();

                $estudiante = Estudiante::find(\Auth::user()->estudiante_id);
                $periodo = Periodo::where('estado','Activo')->first();
                $taller = Taller::findOrFail($request->taller_id);

                $matricula = Matricula::where('estudiante_id',$estudiante->estudiante_id)->where('cod_taller',$taller->cod_taller)->first();
                if($matricula){
                    abort(400,'Usted ya se encuentra matriculada en ese taller.');
                }
                $matricula   = new Matricula();
                $matricula->taller_id      = $taller->taller_id;
                $matricula->cod_taller      = $taller->cod_taller;
                $matricula->estudiante_id  = $estudiante->estudiante_id;
                $matricula->ducumento_estudiante   = $estudiante->documento;
                $matricula->periodo_id   = $periodo->periodo_id;
                $matricula->nivel   = $estudiante->nivel;
                $matricula->grado   = $estudiante->grado;
                $matricula->seccion   = $estudiante->seccion;
                $matricula->save();
                //verificar cantidad de vacantes despues de la insercion
                $vancatesDisponibles = $this->vacantesDisponibles($request->taller_id);

                if( $vancatesDisponibles >= 0)
                {
                    DB::commit();
                    return response()->json([
                        'response'=> 'success'
                    ],201);
                }
                else{
                    DB::rollback();
                    return response()->json([
                        'response'=> 'No hay vacantes disponibles para el taller: '.$taller->nombre
                    ],400);
                }



            } catch (\Exception $e) {
                DB::rollback();
                abort(500,$e->getMessage());
            }

        }
    }

    public function constancia()
    {
        $periodo = Periodo::where('estado','Activo')->first();
        $estudiante = Estudiante::find(\Auth::user()->estudiante_id);
        $matriculas = Matricula::where('estudiante_id',\Auth::user()->estudiante_id)->where('periodo_id',$periodo->periodo_id)->get();


        $view = \View::make('pdf.constancia_matricula',compact('estudiante','matriculas'))->render();

        $pdf  = PDF::loadHTML($view)->setPaper('a5', 'landscape')->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif', 'enable_remote' => false]);

        // $pdf->loadHTML($view);
        return $pdf->download('Constancia-matricula-'.$estudiante->documento.'.pdf');
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

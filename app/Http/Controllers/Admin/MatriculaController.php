<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matricula;
use App\Models\Periodo;
use App\Models\Taller;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;
use App\Exports\MatriculaExport;

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
                                ->orderBy('nivel','DESC')
                                ->orderBy('grado','DESC')
                                ->orderBy('seccion','ASC')
                                ->with(['estudiante' => function ($query) {
                                    $query->orderBy('apellido_paterno','DESC');
                                }])
                                ->paginate(50);

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

    public function reporteMatriculasExcel(Request $request)
    {
        $nombreTaller = '(VARIOS)';

        $periodo = Periodo::where('estado','Activo')->first();
        $taller = Taller::find($request->taller_id);
        $matriculas = Matricula::where('periodo_id',$periodo->periodo_id)
                                ->taller($request->taller_id)
                                ->codTaller($request->cod_taller)
                                ->documentoEstudiante($request->documento_estudiante)
                                ->nivel($request->nivel)
                                ->grado($request->grado)
                                ->seccion($request->seccion)
                                ->orderBy('nivel','DESC')
                                ->orderBy('grado','DESC')
                                ->orderBy('seccion','ASC')
                                ->with(['estudiante' => function ($query) {
                                    $query->orderBy('apellido_paterno','DESC');
                                }])
                                ->get();

        if($taller){
            $nombreTaller = $taller->nombre;
        }

        return \Excel::download(new MatriculaExport($matriculas,$nombreTaller),'ReporteMatriculas.xlsx');
    }

    public function reporteMatriculasPdf(Request $request)
    {
        $nombreTaller = '(VARIOS)';

        $periodo = Periodo::where('estado','Activo')->first();
        $taller = Taller::find($request->taller_id);
        $matriculas = Matricula::where('periodo_id',$periodo->periodo_id)
                                ->taller($request->taller_id)
                                ->codTaller($request->cod_taller)
                                ->documentoEstudiante($request->documento_estudiante)
                                ->nivel($request->nivel)
                                ->grado($request->grado)
                                ->seccion($request->seccion)
                                ->orderBy('nivel','DESC')
                                ->orderBy('grado','DESC')
                                ->orderBy('seccion','ASC')

                                ->with(['estudiante' => function ($query) {
                                    $query->orderBy('apellido_paterno','DESC');
                                }])
                                ->get();

        if($taller){
            $nombreTaller = $taller->nombre;
        }

        $pdf = \App::make('dompdf.wrapper');
        $view = \View::make('pdf.lista_matriculas',compact('nombreTaller','matriculas'))->render();

        $pdf->loadHTML($view)->setPaper('a4', 'portrait')->setOptions(['dpi' => 150,'enable_php'=>true, 'defaultFont' => 'sans-serif', 'enable_remote' => false]);

        // return $pdf->download('REPORTE MATRICULAS-'.date('Y/m/d H:i:s').'.pdf');
        return $pdf->stream('REPORTE MATRICULAS-'.date('Y/m/d H:i:s').'.pdf');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\EstudianteImport;
use Session;
use DB;
use Illuminate\Support\Facades\Storage;

class DatosController extends Controller
{
    public function index()
    {
        return view('admin.importar_excel');
    }

    public function cargaMasiva(Request $request)
    {
        try {
            DB::beginTransaction();
            $archivo=$request->file('archivo');

            \Excel::import(new EstudianteImport, $archivo);
            Session::flash('msg-success','Datos subidos correctamente');

            DB::commit();

            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('msg-error','Error al subir datos: '.$e->getMessage());
            return redirect()->back();
        }

    }

    public function descargarPlantilla(Request $request)
    {

        if(file_exists (public_path('plantilla_carga_alumnos.xlsx')))
        {

            $templatePath= public_path('plantilla_carga_alumnos.xlsx');

            $headers = [
                'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ];

            return response()->download($templatePath, 'template_carga_alumnos.xlsx', $headers);
        }
        else
        {    Session::flash('msg-error','No existe el archivo plantilla');
            return redirect()->back();
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\EstudianteImport;

class DatosController extends Controller
{
    public function index()
    {
        return view('admin.importar_excel');
    }

    public function cargaMasiva(Request $request)
    {
        $archivo=$request->file('archivo');

        \Excel::import(new EstudianteImport, $archivo);

        dd('datos registrados');
    }
}

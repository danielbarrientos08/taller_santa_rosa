<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Http\Requests\Admin\EstudianteCreateRequest;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\EstudianteUpdateRequest;

class EstudianteController extends Controller
{
    public function index ()
    {
        return view('admin.estudiante.index');
    }

    public function listar(Request $request)
    {
        if($request->ajax())
        {
            $estudiantes = Estudiante::WhereRaw("CONCAT_WS(' ',apellido_paterno,apellido_materno,nombres,documento) LIKE ?", ['%'.$request->nombres.'%'])
                                        ->grado($request->grado)->nivel($request->nivel)->paginate(10);

            return response()->json([
                'response'=> $estudiantes
            ],200);
        }
    }

    public function crear(EstudianteCreateRequest $request )
    {
        if($request->ajax())
        {
            unset($request['estudiante_id']);

            $estudiante                     = new Estudiante();
            $estudiante->documento          = $request->documento;
            $estudiante->nombres            = Str::upper($request->nombres);
            $estudiante->apellido_paterno   = Str::upper($request->apellido_paterno);
            $estudiante->apellido_materno   = Str::upper($request->apellido_materno);
            $estudiante->sexo               = $request->sexo;
            $estudiante->fecha_nacimiento   = $request->fecha_nacimiento;
            $estudiante->grado              = $request->grado;
            $estudiante->seccion            = $request->seccion;
            $estudiante->save();

            return response()->json([
                'response'=> $estudiante
            ],201);
        }
    }

    public function actualizar(EstudianteUpdateRequest $request )
    {
        if($request->ajax())
        {
            $user = Estudiante::findOrFail($request->estudiante_id);

            $user->update($request->all());

            $user = Estudiante::findOrFail($request->estudiante_id);

            return response()->json([
                'response'=> $user
            ],200);
        }
    }

    public function eliminar(Request $request )
    {
        if($request->ajax())
        {
            $user = Estudiante::findOrFail($request->estudiante_id);
            $user->delete();

            return response('success',200);
        }
    }

    public function obtener(Request $request,$id )
    {
        if($request->ajax())
        {
            $user = Estudiante::findOrFail($id);

            return response()->json([
                'response'=> $user
            ],200);
        }
    }


}

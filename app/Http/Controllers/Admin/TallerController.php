<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Taller;
use App\Models\Matricula;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\TallerCreateRequest;
use App\Http\Requests\Admin\TallerUpdateRequest;

class TallerController extends Controller
{
    public function index ()
    {
        return view('admin.taller.index');
    }

    public function listar(Request $request)
    {
        if($request->ajax())
        {
            $talleres = Taller::codTaller($request->cod_taller)
                                    ->nombre($request->nombre)
                                    ->grupo($request->grupo)
                                    ->estado($request->estado)
                                    ->paginate(10);

            return response()->json([
                'response'=> $talleres
            ],200);
        }
    }

    public function crear(TallerCreateRequest $request )
    {
        if($request->ajax())
        {

            $taller             = new taller();
            $taller->cod_taller = Str::upper($request->cod_taller);
            $taller->nombre     = Str::upper($request->nombre);
            $taller->vacantes   = $request->vacantes;
            $taller->grupo      = '';
            $taller->estado     = $request->estado;

            $taller->save();

            return response()->json([
                'response'=> $taller
            ],201);
        }
    }

    public function actualizar(TallerUpdateRequest $request )
    {
        if($request->ajax())
        {
            $taller             = Taller::findOrFail($request->taller_id);
            $taller->cod_taller = Str::upper($request->cod_taller);
            $taller->nombre     = Str::upper($request->nombre);
            $taller->vacantes   = $request->vacantes;
            $taller->grupo      = '';
            $taller->estado     = $request->estado;
            $taller->save();

            $taller = Taller::findOrFail($request->taller_id);

            return response()->json([
                'response'=> $taller
            ],200);
        }
    }

    public function eliminar(Request $request )
    {
        if($request->ajax())
        {

            $taller = Taller::findOrFail($request->taller_id);
            $matricula = Matricula::where('taller_id',$taller->taller_id)->first();
            if($matricula){
                abort(409,'Existen registro relacionados');
            }

            $taller->delete();

            return response('success',200);
        }
    }

    public function obtener(Request $request,$id )
    {
        if($request->ajax())
        {

            $taller = Taller::findOrFail($id);

            return response()->json([
                'response'=> $taller
            ],200);
        }
    }
}

<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Estudiante;
use Session;
use Illuminate\Support\Str;

class BoletaController extends Controller
{
    public function index()
    {
        return view('boletas');
    }

    public function buscar(Request $request)
    {
        $documento = trim($request->documento);
        $mensaje = '';
        $nombre_archivo =false;

        $estudiante = Estudiante::where('documento',$documento)->orWhere('codigo_estudiante',$documento)->first();
        
        if($estudiante)
        {
            $nombre_archivo = Str::upper(Str::of($estudiante->documento)->slug('_').'_'.Str::of($estudiante->apellido_paterno)->slug('_').'_'.Str::of($estudiante->apellido_materno)->slug('_').'_'.Str::of($estudiante->nombres)->slug('_')).'.pdf';
            
            if (! file_exists(public_path().'/boletas/'.$nombre_archivo)) 
            {
                $nombre_archivo='';
            }
        }

        if(! $estudiante){
            $mensaje= 'Estudiante no encontrada.';
        }
      
        return view('boletas',['estudiante'=>$estudiante,'mensaje'=>$mensaje,'nombre_archivo'=>$nombre_archivo]);

    }
}

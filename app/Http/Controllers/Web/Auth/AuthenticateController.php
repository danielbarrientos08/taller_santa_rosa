<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Estudiante;
use Illuminate\Support\Facades\Auth;

class AuthenticateController extends Controller
{
    use AuthenticatesUsers;

    public function index ()
    {
        if(Auth::guard()->check())  return redirect('/');

        return view('web.login');
    }


    public function login(Request $request)
    {
        if( $request->ajax())
        {
            $this->validate($request, [
                'usuario' => 'bail|required',
                'password' => 'bail|required',
            ]);
            $estudiante = Estudiante::where('documento',$request->usuario)->where('documento',$request->password)->first();

            if($estudiante)
            {

                Auth::guard('web')->login($estudiante);

                return response()->json([
                    'status'       => 'success',
                    'message'      => 'Acceso correcto.',
                ],200);
            }

            return response()->json([
                'status'  => 'error',
                'message' => 'Usuario o contraseña incorrecto.',
            ],401);
        }
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        return redirect('admin/login');
    }
}

<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthenticateController extends Controller
{
    use AuthenticatesUsers;

    public function index ()
    {
        if(Auth::guard('admin')->check())  return redirect('admin/panel');

        return view('admin.login');
    }

    public function login(Request $request)
    {
        if( $request->ajax())
        {
            $this->validate($request, [
                'email' => 'bail|required|email',
                'password' => 'bail|required',
            ]);

            if(Auth::guard('admin')->attempt(['email'=>$request->email,'estado'=>'Activo','password'=>$request->password]))
            {
                return response()->json([
                    'status'       => 'success',
                    'message'      => 'Acceso correcto.',
                ],200);
            }

            return response()->json([
                'status'  => 'error',
                'message' => 'Email o contraseña incorrecto.',
            ],401);
        }
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        return redirect('admin/login');
    }
}

<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/', [App\Http\Controllers\Web\BoletaController::class, 'index']);
// Route::get('/boletas/buscar', [App\Http\Controllers\Web\BoletaController::class, 'buscar']);



/**Rutas para estudiantes */
Route::get('/login', [App\Http\Controllers\Web\Auth\AuthenticateController::class, 'index'])->name('login');
Route::post('/login',[App\Http\Controllers\Web\Auth\AuthenticateController::class, 'login'])->middleware('throttle:5,1');//5 intentos como máximo en 1 minuto
Route::post('/logout',[App\Http\Controllers\Web\Auth\AuthenticateController::class, 'logout'])->name('logout');
Route::middleware(['auth'])->group(function ()
    {
        Route::get('/', function () {
            return redirect('matriculas');
        });
        Route::get('/matriculas',[App\Http\Controllers\Web\MatriculaController::class, 'index']);
        /**matricula */
        Route::get('/matriculas/constancia', [App\Http\Controllers\Web\MatriculaController::class, 'constancia']);
        Route::get('/matriculas/listar', [App\Http\Controllers\Web\MatriculaController::class, 'listar']);
        Route::post('/matriculas/crear', [App\Http\Controllers\Web\MatriculaController::class, 'crear']);
        Route::put('/matriculas/actualizar', [App\Http\Controllers\Web\MatriculaController::class, 'actualizar']);
        Route::delete('/matriculas/eliminar/{id}', [App\Http\Controllers\Web\MatriculaController::class, 'eliminar']);
        Route::get('/matriculas/vacantes/{taller_id}', [App\Http\Controllers\Web\MatriculaController::class, 'vacantes']);

    });

/**Rutas para administrador */
Route::prefix('admin')->group(function ()
{
    Route::get('/login', [App\Http\Controllers\Admin\Auth\AuthenticateController::class, 'index'])->name('admin.login');
    Route::post('/login',[App\Http\Controllers\Admin\Auth\AuthenticateController::class, 'login'])->middleware('throttle:5,1');//5 intentos como máximo en 1 minuto
    Route::post('/logout',[App\Http\Controllers\Admin\Auth\AuthenticateController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth:admin'])->group(function ()
    {
        Route::get('/panel',[App\Http\Controllers\Admin\PanelController::class, 'index'])->name('panel');
        /**Rutas admin estudiante */
        Route::get('/estudiantes', [App\Http\Controllers\Admin\EstudianteController::class, 'index']);
        Route::get('/estudiantes/listar', [App\Http\Controllers\Admin\EstudianteController::class, 'listar']);
        Route::post('/estudiantes/crear', [App\Http\Controllers\Admin\EstudianteController::class, 'crear']);
        Route::put('/estudiantes/actualizar', [App\Http\Controllers\Admin\EstudianteController::class, 'actualizar']);
        Route::delete('/estudiantes/eliminar', [App\Http\Controllers\Admin\EstudianteController::class, 'eliminar']);
        Route::get('/estudiantes/obtener/{id_estudiante}', [App\Http\Controllers\Admin\EstudianteController::class, 'obtener']);

        /**Matrículas */
        Route::get('/matriculas',[App\Http\Controllers\Admin\MatriculaController::class, 'index']);
        Route::get('/matriculas/listar', [App\Http\Controllers\Admin\MatriculaController::class, 'listar']);
        Route::delete('/matriculas/eliminar/{id}', [App\Http\Controllers\Admin\MatriculaController::class, 'eliminar']);
        /**Carga masicva de estudiantes */
        Route::get('/estudiantes/cargaMasiva', [App\Http\Controllers\Admin\DatosController::class, 'index']);
        Route::post('/estudiantes/cargaMasiva', [App\Http\Controllers\Admin\DatosController::class, 'cargaMasiva']);
    });
});

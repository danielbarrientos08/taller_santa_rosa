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
Route::get('/', [App\Http\Controllers\Web\BoletaController::class, 'index']);
Route::get('/boletas/buscar', [App\Http\Controllers\Web\BoletaController::class, 'buscar']);
Route::get('/datos', [App\Http\Controllers\Web\DatosController::class, 'index']);
Route::post('/datos/cargaMasiva', [App\Http\Controllers\Web\DatosController::class, 'cargaMasiva']);

 Route::prefix('admin')->group(function () 
 {
    /**Rutas admin estudiante */
    Route::get('/estudiantes', [App\Http\Controllers\Admin\EstudianteController::class, 'index']);
    Route::get('/estudiantes/listar', [App\Http\Controllers\Admin\EstudianteController::class, 'listar']);
    Route::post('/estudiantes/crear', [App\Http\Controllers\Admin\EstudianteController::class, 'crear']);
    Route::put('/estudiantes/actualizar', [App\Http\Controllers\Admin\EstudianteController::class, 'actualizar']);
    Route::delete('/estudiantes/eliminar', [App\Http\Controllers\Admin\EstudianteController::class, 'eliminar']);
    Route::get('/estudiantes/obtener/{id_estudiante}', [App\Http\Controllers\Admin\EstudianteController::class, 'obtener']);

});
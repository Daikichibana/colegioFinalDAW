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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Usuario
Route::get('/user/buscarEstudiante',[App\Http\Controllers\UserController::class, 'buscarDatosEstudiante']);
Route::get('/user/buscarDocente',[App\Http\Controllers\UserController::class, 'buscarDatosDocente']);

//Estudiante
Route::get('/estudiante',[App\Http\Controllers\EstudianteController::class, 'index']);
Route::post('/estudiante/registrar',[App\Http\Controllers\EstudianteController::class, 'store']);
Route::put('/estudiante/modificar',[App\Http\Controllers\EstudianteController::class, 'update']);
Route::put('/estudiante/eliminar',[App\Http\Controllers\EstudianteController::class, 'delete']);

//Materia
Route::get('/materia',[App\Http\Controllers\MateriaController::class, 'index']);
Route::post('/materia/registrar',[App\Http\Controllers\MateriaController::class, 'store']);
Route::put('/materia/modificar',[App\Http\Controllers\MateriaController::class, 'update']);
Route::put('/materia/eliminar',[App\Http\Controllers\MateriaController::class, 'delete']);

//Users
Route::get('/users',[App\Http\Controllers\UserController::class, 'index']);
Route::post('/users/registrar',[App\Http\Controllers\UserController::class, 'store']);
Route::put('/users/modificar',[App\Http\Controllers\UserController::class, 'update']);
Route::put('/users/eliminar',[App\Http\Controllers\UserController::class, 'delete']);


//Inscripcion
Route::get('/inscripcion',[App\Http\Controllers\InscripcionController::class, 'index']);
Route::post('/inscripcion/registrar',[App\Http\Controllers\InscripcionController::class, 'store']);
Route::put('/inscripicion/modificar',[App\Http\Controllers\InscripcionController::class, 'update']);
Route::put('/inscripcion/eliminar',[App\Http\Controllers\InscripcionController::class, 'delete']);
Route::get('/inscripcion/obtenerDetalles',[App\Http\Controllers\InscripcionController::class, 'obtenerDetalles']);
Route::get('/inscripcion/obtenerCabecera',[App\Http\Controllers\InscripcionController::class, 'obtenerCabecera']);
//Route::get('/frmbuscarcurso', [App\Http\Controllers\AsignacionCursoGestionController::class, 'index']);
//Route::get('/frmbuscarnotas', [App\Http\Controllers\NotaController::class, 'index']);

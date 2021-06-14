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

//Gestion
Route::get('/gestion',[App\Http\Controllers\GestionController::class, 'index']);
Route::post('/gestion/registrar',[App\Http\Controllers\GestionController::class, 'store']);
Route::put('/gestion/modificar',[App\Http\Controllers\GestionController::class, 'update']);
Route::put('/gestion/eliminar',[App\Http\Controllers\GestionController::class, 'delete']);

//Curso
Route::get('/curso',[App\Http\Controllers\CursoController::class, 'index']);
Route::post('/curso/registrar',[App\Http\Controllers\CursoController::class, 'store']);
Route::put('/curso/modificar',[App\Http\Controllers\CursoController::class, 'update']);
Route::put('/curso/eliminar',[App\Http\Controllers\CursoController::class, 'delete']);

//Aula
Route::get('/aula',[App\Http\Controllers\AulaController::class, 'index']);
Route::post('/aula/registrar',[App\Http\Controllers\AulaController::class, 'store']);
Route::put('/aula/modificar',[App\Http\Controllers\AulaController::class, 'update']);
Route::put('/aula/eliminar',[App\Http\Controllers\AulaController::class, 'delete']);

//Paralelo
Route::get('/paralelo',[App\Http\Controllers\ParaleloController::class, 'index']);
Route::post('/paralelo/registrar',[App\Http\Controllers\ParaleloController::class, 'store']);
Route::put('/paralelo/modificar',[App\Http\Controllers\ParaleloController::class, 'update']);
Route::put('/paralelo/eliminar',[App\Http\Controllers\ParaleloController::class, 'delete']);

//Bimestre
Route::get('/bimestre',[App\Http\Controllers\BimestreController::class, 'index']);
Route::post('/bimestre/registrar',[App\Http\Controllers\BimestreController::class, 'store']);
Route::put('/bimestre/modificar',[App\Http\Controllers\BimestreController::class, 'update']);
Route::put('/bimestre/eliminar',[App\Http\Controllers\BimestreController::class, 'delete']);

//Turno
Route::get('/turno',[App\Http\Controllers\TurnoController::class, 'index']);
Route::post('/turno/registrar',[App\Http\Controllers\TurnoController::class, 'store']);
Route::put('/turno/modificar',[App\Http\Controllers\TurnoController::class, 'update']);
Route::put('/turno/eliminar',[App\Http\Controllers\TurnoController::class, 'delete']);
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
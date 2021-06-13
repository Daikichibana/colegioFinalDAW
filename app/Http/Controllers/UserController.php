<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\Docente;
use DB;

class UserController extends Controller
{
    public function buscarDatosEstudiante(Request $request){
        $buscar= $request->buscar;

        $estudiante=Estudiante::where('idUsuario','=', $buscar)->get();
        
        return $estudiante;
    }

    public function buscarDatosDocente(Request $request){
        $buscar= $request->buscar;

        $docente=Docente::where('idUsuario','=', $buscar)->get();
        
        return $docente;
    }
}

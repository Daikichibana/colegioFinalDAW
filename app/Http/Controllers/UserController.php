<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\Docente;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DB;

class UserController extends Controller
{


    public function index(Request $request){
        $buscar= $request->buscar;
        if($buscar==''){
            $user=User::all();
        }
        else{
            $user=User::where('username','like','%'.$buscar.'%')
            ->get();
        }
        
        return $user;
    }

    public function store(Request $request){
        $user = new User;
        $user->username=$request->username;
        $user->password=Hash::make($request->password);
        $user->rol=$request->rol;
        $user->save();
    }

    public function update(Request $request){
        $user = user::findOrFail($request->id);
        $user->username=$request->username;
        $user->password=Hash::make($request->password);
        $user->rol=$request->rol;
        $user->save();
    }

    public function delete(Request $request){
        $user = user::findOrFail($request->id);
        $user->delete();
    } 



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

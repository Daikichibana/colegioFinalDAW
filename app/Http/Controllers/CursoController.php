<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use DB;

class CursoController extends Controller
{
    public function index(Request $request){
        $buscar= $request->buscar;
        if($buscar==''){
            $Curso=Curso::all();
        }
        else{
            $Curso=Curso::where('nombre','like','%'.$buscar.'%')->get();
        }
        
        return $Curso;
    }

    public function store(Request $request){
        $Curso = new Curso;
        $Curso->nombre=$request->nombre;
        $Curso->save();
    }

    public function update(Request $request){
        $Curso = Curso::findOrFail($request->id);
        $Curso->nombre=$request->nombre;
        $Curso->save();
    }
    public function delete(Request $request){
        $Curso = Curso::findOrFail($request->id);
        $Curso->delete();
    }
}

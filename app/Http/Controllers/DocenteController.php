<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente;
use DB;

class DocenteController extends Controller
{
    public function index(Request $request){
        $buscar= $request->buscar;
        if($buscar==''){
            $docente=Docente::all();
        }
        else{
            $docente=Docente::where('nombre','like','%'.$buscar.'%')
            ->get();}
        
        return $docente;
    }

    public function store(Request $request){
        $docente = new Docente;
        $docente->nombre=$request->nombre;
        $docente->apellido=$request->apellido;
        $docente->telefono=$request->telefono;
        $docente->idUsuario=$request->idUsuario;

        $docente->save();
    }

    public function update(Request $request){
        $docente = Docente::findOrFail($request->id);
        $docente->nombre=$request->nombre;
        $docente->apellido=$request->apellido;
        $docente->telefono=$request->telefono;
        $docente->idUsuario=$request->idUsuario;
        $docente->save();
    }

    public function delete(Request $request){
        $docente = Docente::findOrFail($request->id);
        $docente->delete();
    }    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use DB;

class EstudianteController extends Controller
{
    public function index(Request $request){
        $buscar= $request->buscar;
        if($buscar==''){
            $estudiante=Estudiante::all();
        }
        else{
            $estudiante=Estudiante::where('nombre','like','%'.$buscar.'%')
            ->get();}
        
        return $estudiante;
    }

    public function store(Request $request){
        $estudiante = new Estudiante;
        $estudiante->nombre=$request->nombre;
        $estudiante->apellido=$request->apellido;
        $estudiante->telefono=$request->telefono;
        $estudiante->fechaNacimiento=$request->fechaNacimiento;
        $estudiante->direccion=$request->direccion;

        $estudiante->save();
    }

    public function update(Request $request){
        $estudiante = Estudiante::findOrFail($request->id);
        $estudiante->nombre=$request->nombre;
        $estudiante->apellido=$request->apellido;
        $estudiante->telefono=$request->telefono;
        $estudiante->fechaNacimiento=$request->fechaNacimiento;
        $estudiante->direccion=$request->direccion;
        $estudiante->idUsuario=$request->idUsuario;
        $estudiante->save();
    }
    public function delete(Request $request){
        $estudiante = Estudiante::findOrFail($request->id);
        $estudiante->delete();
    }    
}


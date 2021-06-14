<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apoderado;
use DB;

class ApoderadoController extends Controller
{
    public function index(Request $request){

        $buscar= $request->buscar;
        if($buscar==''){
            $apoderado=Apoderado::all();
        }

        else{
            $apoderado=Apoderado::where('nombre','like','%'.$buscar.'%')->get();

        }
        return $apoderado;
    }
    public function store(Request $request){
        $apoderado=new Apoderado;
        $apoderado->nombre=$request->nombre;
        $apoderado->apellido=$request->apellido;
        $apoderado->telefono=$request->telefono;
        $apoderado->direccion=$request->direccion;
        $apoderado->fechaNacimiento=$request->fechaNacimiento;
        $apoderado->save();
    }
    public function update(Request $request){
        $apoderado=Apoderado::findOrFail($request->id);
        $apoderado->nombre=$request->nombre;
        $apoderado->apellido=$request->apellido;
        $apoderado->telefono=$request->telefono;
        $apoderado->direccion=$request->direccion;
        $apoderado->fechaNacimiento=$request->fechaNacimiento;
        $apoderado->save();
    }
    public function selectApoderado(Request $request){
        $filtro=$request->filtro;
        $apoderado= Apoderado::where('nombre','like','%'.$filtro.'%')
        ->select('id','nombre','apellido','telefono', 'direccion','fechaNacimiento')
        ->get();
        return $apoderado;
    }
    public function delete(Request $request){
        $apoderado = Apoderado::findOrFail($request->id);
        $apoderado->delete();
    }    
}


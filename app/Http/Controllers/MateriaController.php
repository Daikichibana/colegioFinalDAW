<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia;
use DB;

class MateriaController extends Controller
{
    public function index(Request $request){
        $buscar= $request->buscar;
        if($buscar==''){
            $materia=Materia::all();
        }
        else{
            $materia=Materia::where('nombre','like','%'.$buscar.'%')
            ->get();}
        
        return $materia;
    }

    public function buscarMateriaPorId(Request $request){
        $buscar= $request->buscar;
        if($buscar==''){
            $materia=Materia::all();
        }
        else{
            $materia=Materia::where('id','=', $buscar)
            ->get();}
        
        return $materia;
    }

    public function store(Request $request){
        $materia = new Materia;
        $materia->nombre=$request->nombre;

        $materia->save();
    }

    public function update(Request $request){
        $materia = Materia::findOrFail($request->id);
        $materia->nombre=$request->nombre;
        $materia->save();
    }
    public function delete(Request $request){
        $materia = Materia::findOrFail($request->id);
        $materia->delete();
    }    
}

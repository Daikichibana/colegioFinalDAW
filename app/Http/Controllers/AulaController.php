<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aula;
use DB;

class AulaController extends Controller
{
    public function index(Request $request){
        $buscar= $request->buscar;
        $buscar2= $request->buscar2;
        if($buscar==''||$buscar2==''){
            $Aula=Aula::all();
        }
        else{
            $Aula=Aula::select('*')->whereBetween('capacidad',[$buscar, $buscar2])->get();
        }
        
        return $Aula;
    }

    public function store(Request $request){
        $Aula = new Aula;
        $Aula->descripcion=$request->descripcion;
        $Aula->capacidad=$request->capacidad;
        $Aula->save();
    }

    public function update(Request $request){
        $Aula = Aula::findOrFail($request->id);
        $Aula->descripcion=$request->descripcion;
        $Aula->capacidad=$request->capacidad;
        $Aula->save();
    }
    public function delete(Request $request){
        $Aula = Aula::findOrFail($request->id);
        $Aula->delete();
    }
    public function buscarAulaPorId(Request $request){
        $buscar= $request->buscar;
        if($buscar==''){
            $Aula=Aula::all();
        }
        else{
            $Aula=Aula::where('id','=', $buscar)
            ->get();}
        
        return $Aula;
    }
}

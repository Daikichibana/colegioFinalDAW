<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Bimestre extends Controller
{
    public function index(Request $request){
        $buscar= $request->buscar;
        if($buscar==''){
            $bimestre=Bimestre::all();
        }
        else{
            $bimestre=Bimestre::where('bimestre','like','%'.$buscar.'%')
            ->get();}
        
        return $bimestre;
    }

    public function store(Request $request){
        $bimestre = new Bimestre;
        $bimestre->bimestre=$request->bimestre;

        $bimestre->save();
    }

    public function update(Request $request){
        $bimestre = Paralelo::findOrFail($request->id);
        $bimestre->bimestre=$request->bimestre;
        
        $bimestre->save();
    }
    public function delete(Request $request){
        $bimestre = Bimestre::findOrFail($request->id);
        $bimestre->delete();
    }  
}

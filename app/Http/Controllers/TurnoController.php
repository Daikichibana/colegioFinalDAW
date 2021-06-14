<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turno;
use DB;

class TurnoController extends Controller
{
    public function index(Request $request){
        $buscar= $request->buscar;
        if($buscar==''){
            $turno=Turno::all();
        }
        else{
            $turno=Turno::where('nombre','like','%'.$buscar.'%')
            ->get();}
        
        return $turno;
    }

    public function store(Request $request){
        $turno = new Turno;
        $turno->nombre=$request->nombre;

        $turno->save();
    }

    public function update(Request $request){
        $turno = Turno::findOrFail($request->id);
        $turno->nombre=$request->nombre;
        
        $turno->save();
    }
    public function delete(Request $request){
        $turno = Turno::findOrFail($request->id);
        $turno->delete();
    }  
}

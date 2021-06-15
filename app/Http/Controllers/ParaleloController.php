<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paralelo;
use DB;

class ParaleloController extends Controller
{
    public function index(Request $request){
        $buscar= $request->buscar;
        if($buscar==''){
            $paralelo=Paralelo::all();
        }
        else{
            $paralelo=Paralelo::where('nombre','like','%'.$buscar.'%')
            ->get();}
        
        return $paralelo;
    }

    public function store(Request $request){
        $paralelo = new Paralelo;
        $paralelo->nombre=$request->nombre;

        $paralelo->save();
    }

    public function update(Request $request){
        $paralelo = Paralelo::findOrFail($request->id);
        $paralelo->nombre=$request->nombre;
        
        $paralelo->save();
    }
    public function delete(Request $request){
        $paralelo = Paralelo::findOrFail($request->id);
        $paralelo->delete();
    }    
}


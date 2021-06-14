<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gestion;
use DB;

class GestionController extends Controller
{
    public function index(Request $request){
        $buscar= $request->buscar;
        $buscar2= $request->buscar2;
        if($buscar==''||$buscar2==''){
            $Gestion=Gestion::all();
        }
        else{
            $Gestion=Gestion::select('*')->whereBetween('año',[$buscar, $buscar2])->get();
        }
        
        return $Gestion;
    }
    public function index2(Request $request){
        $buscar= $request->buscar;
        if($buscar==''){
            $Gestion=Gestion::all();
        }
        else{
            $Gestion=Gestion::where('id','=',$buscar)->get();
        }
        
        return $Gestion;
    }

    public function store(Request $request){
        $Gestion = new Gestion;
        $Gestion->año=$request->año;
        $Gestion->save();
    }

    public function update(Request $request){
        $Gestion = Gestion::findOrFail($request->id);
        $Gestion->año=$request->año;
        $Gestion->save();
    }
    public function delete(Request $request){
        $Gestion = Gestion::findOrFail($request->id);
        $Gestion->delete();
    }    
}

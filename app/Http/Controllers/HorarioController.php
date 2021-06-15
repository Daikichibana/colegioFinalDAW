<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use DB;

class HorarioController extends Controller
{
    public function index(Request $request){
        $buscar= $request->buscar;
        if($buscar==''){
            $horario=Horario::all();
        }
        else{
            $horario=Horario::where('id','=',$buscar)
            ->get();}
    
        return $horario;
    }

    public function store(Request $request){
        $horario = new Horario;
        $horario->horaInicio=$request->horaInicio;
        $horario->horaFinalizacion=$request->horaFinalizacion;
        $horario->dia=$request->dia;
        $horario->codTurno=$request->codTurno;
        $horario->save();
    }

    public function update(Request $request){
        $horario = Horario::findOrFail($request->id);
        $horario->horaInicio=$request->horaInicio;
        $horario->horaFinalizacion=$request->horaFinalizacion;
        $horario->dia=$request->dia;
        $horario->codTurno=$request->codTurno;
        $horario->save();
    }
    public function delete(Request $request){
        $horario = Horario::findOrFail($request->id);
        $horario->delete();
    }
    
    public function buscarHorarioPorId(Request $request){
        $buscar= $request->buscar;
        if($buscar==''){
            $horario=Horario::all();
        }
        else{
            $horario=Horario::where('id','=', $buscar)
            ->get();}
        
        return $horario;
    }
}

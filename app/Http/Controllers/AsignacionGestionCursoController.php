<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AsignacionCursoGestion;
use DB;

class AsignacionGestionCursoController extends Controller
{
    public function index(Request $request){
        $buscar= $request->buscar;
        if($buscar==0){
            $asignacion=AsignacionCursoGestion::all();
        }
        else{
            $asignacion=AsignacionCursoGestion::where('id','=',$buscar)->get();
        }
        
        return $asignacion;
    }

    public function store(Request $request){
        $asignacion = new AsignacionCursoGestion;
        $asignacion->codCurso=$request->codCurso;
        $asignacion->codGestion=$request->codGestion;
        $asignacion->codParalelo=$request->codParalelo;
        $asignacion->save();
    }

    public function update(Request $request){
        $asignacion = AsignacionCursoGestion::findOrFail($request->id);
        $asignacion->codCurso=$request->codCurso;
        $asignacion->codGestion=$request->codGestion;
        $asignacion->codParalelo=$request->codParalelo;
        $asignacion->save();
    }
    public function delete(Request $request){
        $asignacion = AsignacionCursoGestion::findOrFail($request->id);
        $asignacion->delete();
    }
}

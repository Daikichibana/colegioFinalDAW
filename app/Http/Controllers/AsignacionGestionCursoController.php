<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\asignaciongestioncurso;
use DB;

class AsignacionGestionCursoController extends Controller
{
    public function index(Request $request){
        $buscar= $request->buscar;
        if($buscar==0){
            $asignacion=asignaciongestioncurso::all();
        }
        else{
            $asignacion=asignaciongestioncurso::where('id','=',$buscar)->get();
        }
        
        return $asignacion;
    }

    public function store(Request $request){
        $asignacion = new asignaciongestioncurso;
        $asignacion->codCurso=$request->codCurso;
        $asignacion->codGestion=$request->codGestion;
        $asignacion->codParalelo=$request->codParalelo;
        $asignacion->save();
    }

    public function update(Request $request){
        $asignacion = asignaciongestioncurso::findOrFail($request->id);
        $asignacion->codCurso=$request->codCurso;
        $asignacion->codGestion=$request->codGestion;
        $asignacion->codParalelo=$request->codParalelo;
        $asignacion->save();
    }
    public function delete(Request $request){
        $asignacion = asignaciongestioncurso::findOrFail($request->id);
        $asignacion->delete();
    }

    public function buscarCurso(Request $request){

        $buscar= $request->buscar;
        if($buscar==''){
            $s=DB::table('asignaciongestioncurso')
            ->join('gestion', 'codGestion', '=', 'gestion.id')
            ->join('curso', 'codCurso', '=', 'curso.id')
            ->join('paralelo', 'codParalelo', '=', 'paralelo.id')
            ->select('asignaciongestioncurso.id',  
                        'curso.nombre as curso_nombre', 
                        'gestion.año as gestion_nombre',
                        'paralelo.nombre as paralelo_nombre'
                    )
            ->orderBy('id', 'asc')
            ->get();
        }

        else{
             $s=DB::table('asignaciongestioncurso')
             ->join('gestion', 'codGestion', '=', 'gestion.id')
             ->join('curso', 'codCurso', '=', 'curso.id')
             ->join('paralelo', 'codParalelo', '=', 'paralelo.id')
             ->select('asignaciongestioncurso.id',  
                         'curso.nombre as curso_nombre', 
                         'gestion.año as gestion_nombre',
                         'paralelo.nombre as paralelo_nombre'
                     )
             ->where('curso.nombre','like','%'.$buscar.'%')
             ->orderBy('id', 'asc')
             ->get();
        }
        return $s;
    }
}

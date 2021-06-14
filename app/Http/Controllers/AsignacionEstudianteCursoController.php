<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\asignacionestudiantecurso;
use DB;

class AsignacionEstudianteCursoController extends Controller
{
    public function index(Request $request){
        $buscar= $request->buscar;
        if($buscar==0){
            $asignacion=asignacionestudiantecurso::all();
        }
        else{
            $asignacion=asignacionestudiantecurso::where('id','=',$buscar)->get();
        }
        
        return $asignacion;
    }

    public function store(Request $request){
        $asignacion = new asignacionestudiantecurso;
        $asignacion->codEstudiante=$request->codCurso;
        $asignacion->codMateriaCurso=$request->codMateriaCurso;
        $asignacion->save();
    }

    public function update(Request $request){
        $asignacion = asignacionestudiantecurso::findOrFail($request->id);
        $asignacion->codEstudiante=$request->codCurso;
        $asignacion->codMateriaCurso=$request->codMateriaCurso;
        $asignacion->save();
    }
    public function delete(Request $request){
        $asignacion = asignacionestudiantecurso::findOrFail($request->id);
        $asignacion->delete();
    }

    public function buscarCurso(Request $request){

        $buscar= $request->buscar;
        if($buscar==''){
            $s=DB::table('asignaciongestioncurso')
            ->join('estudiante', 'codEstudiante', '=', 'estudiante.id')
            ->join('materiacurso', 'codMateriaCurso', '=', 'materiacurso.id')
            ->select('asignacionestudiantecurso.id',  
                        'materiacurso.nombre as materiacurso_nombre', 
                        'estudiante.nombre as estudiante_nombre',
                    )
            ->orderBy('id', 'asc')
            ->get();
        }

        else{
             $s=DB::table('asignacionestudiantecurso')
             ->join('estudiante', 'codEstudiante', '=', 'estudiante.id')
            ->join('materiacurso', 'codMateriaCurso', '=', 'materiacurso.id')
            ->select('asignacionestudiantecurso.id',  
                        'materiacurso.nombre as materiacurso_nombre', 
                        'estudiante.nombre as estudiante_nombre',
                     )
             ->where('materiacurso.nombre','like','%'.$buscar.'%')
             ->orderBy('id', 'asc')
             ->get();
        }
        return $s;
    }
}
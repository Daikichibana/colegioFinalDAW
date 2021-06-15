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
            //$asignacion=AsignacionEstudianteCurso::all();
            $s=DB::table('asignacionestudiantecurso')
            ->join('estudiante', 'codEstudiante', '=', 'estudiante.id')
            ->join('asignacionCursoMateria', 'codMateriaCurso', '=', 'asignacioncursomateria.id')
            ->join('gestion', 'codGestion', '=', 'gestion.id')
            ->join('curso', 'codCurso', '=', 'curso.id')
            ->select('asignacionestudiantecurso.id',  
            'estudiante.nombre as estudiante_nombre',
            'asignaciongestioncurso.id as codCursoGestion', 
            'curso.nombre as nombreCurso', 
            'gestion.año as gestionCurso',
                    )
            ->orderBy('id', 'asc')
            ->get();
        }
        else{
            //$asignacion=AsignacionEstudianteCurso::where('id','=',$buscar)->get();

        $s=DB::table('asignacionestudiantecurso')
            ->join('estudiante', 'codEstudiante', '=', 'estudiante.id')
            ->join('asignacionCursoMateria', 'codMateriaCurso', '=', 'asignacioncursomateria.id')
            ->join('gestion', 'codGestion', '=', 'gestion.id')
            ->join('curso', 'codCurso', '=', 'curso.id')
            ->select('asignacionestudiantecurso.id',  
            'estudiante.nombre as estudiante_nombre',
            'asignaciongestioncurso.id as codCursoGestion', 
            'curso.nombre as nombreCurso', 
            'gestion.año as gestionCurso',
                     )
             ->where('curso.nombre','like','%'.$buscar.'%')
             ->orderBy('id', 'asc')
             ->get();
        }
        return $s;
    }

    public function store(Request $request){
        $asignacion = new AsignacionEstudianteCurso;
        $asignacion->codEstudiante=$request->codEstudiante;
        $asignacion->codMateriaCurso=$request->codMateriaCurso;
        $asignacion->save();
    }

    public function update(Request $request){
        $asignacion = AsignacionEstudianteCurso::findOrFail($request->id);
        $asignacion->codEstudiante=$request->codEstudiante;
        $asignacion->codMateriaCurso=$request->codMateriaCurso;
        $asignacion->save();
    }
    public function delete(Request $request){
        $asignacion = AsignacionEstudianteCurso::findOrFail($request->id);
        $asignacion->delete();
    }
}
   
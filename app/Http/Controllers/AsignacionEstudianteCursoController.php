<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AsignacionCursoEstudiante;
use DB;

class AsignacionEstudianteCursoController extends Controller
{
    public function index(Request $request){
        $buscar= $request->buscar;
        if($buscar==0){
          
            $s=DB::table('asignacionestudiantecurso')->join('estudiante', 'codEstudiante', '=', 'estudiante.id')->join('asignacionmateriacurso', 'codMateriaCurso', '=', 'asignacionmateriacurso.id')->join('materia', 'codMateria', '=', 'materia.id')->join('docente', 'codDocente', '=', 'docente.id')->join('asignaciongestioncurso', 'codCursoGestion', '=', 'asignaciongestioncurso.id')->join('paralelo', 'codParalelo', '=', 'paralelo.id')->join('gestion', 'codGestion', '=', 'gestion.id')->join('curso', 'codCurso', '=', 'curso.id')->select('asignacionestudiantecurso.codMateriaCurso','asignacionestudiantecurso.codEstudiante','asignacionestudiantecurso.id as Id','estudiante.nombre as Nombre','curso.nombre as Curso','gestion.año as Gestion','paralelo.nombre as Paralelo','materia.nombre as Materia','docente.nombre as Docente')->orderBy('id', 'asc')->get();
        }
        else{
            $s=DB::table('asignacionestudiantecurso')->join('estudiante', 'codEstudiante', '=', 'estudiante.id')->join('asignacionmateriacurso', 'codMateriaCurso', '=', 'asignacionmateriacurso.id')->join('materia', 'codMateria', '=', 'materia.id')->join('docente', 'codDocente', '=', 'docente.id')->join('asignaciongestioncurso', 'codCursoGestion', '=', 'asignaciongestioncurso.id')->join('paralelo', 'codParalelo', '=', 'paralelo.id')->join('gestion', 'codGestion', '=', 'gestion.id')->join('curso', 'codCurso', '=', 'curso.id')->select('asignacionestudiantecurso.codMateriaCurso','asignacionestudiantecurso.codEstudiante','asignacionestudiantecurso.id as Id','estudiante.nombre as Nombre','curso.nombre as Curso','gestion.año as Gestion','paralelo.nombre as Paralelo','materia.nombre as Materia','docente.nombre as Docente')
             ->where('asignacionestudiantecurso.id','=',$buscar)
             ->orderBy('id','asc')
             ->get();
        }
        return $s;
    }

    public function store(Request $request){
        $asignacion = new AsignacionCursoEstudiante;
        $asignacion->codEstudiante=$request->codEstudiante;
        $asignacion->codMateriaCurso=$request->codMateriaCurso;
        $asignacion->save();
    }

    public function update(Request $request){
        $asignacion = AsignacionCursoEstudiante::findOrFail($request->id);
        $asignacion->codEstudiante=$request->codEstudiante;
        $asignacion->codMateriaCurso=$request->codMateriaCurso;
        $asignacion->save();
    }
    public function delete(Request $request){
        $asignacion = AsignacionCursoEstudiante::findOrFail($request->id);
        $asignacion->delete();
    }
}
   
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AsignacionCursoMateria;
use DB;

class AsignacionCursoMateriaController extends Controller
{
    public function index(Request $request){
        $buscar= $request->buscar;
        if($buscar==0){
            //$asignacion=AsignacionCursoMateria::all();

            $s=DB::table('asignacionmateriacurso')
            ->join('materia', 'codMateria', '=', 'materia.id')
            ->join('asignaciongestioncurso', 'codCursoGestion', '=', 'asignaciongestioncurso.id')
            ->join('gestion', 'codGestion', '=', 'gestion.id')
            ->join('curso', 'codCurso', '=', 'curso.id')
            ->join('paralelo', 'codParalelo', '=', 'paralelo.id')
            ->join('docente', 'codDocente', '=', 'docente.id')
            ->select('asignacionmateriacurso.id',  
                        'asignaciongestioncurso.id as codCursoGestion', 
                        'curso.nombre as nombreCurso', 
                        'gestion.año as gestionCurso',
                        'paralelo.nombre as nombreParalelo',

                        'materia.id as codMateria', 
                        'materia.nombre as nombreMateria', 

                        'docente.id as codDocente',
                        'docente.nombre as nombreDocente',
                        'docente.apellido as apellidoDocente'
                    )
            ->orderBy('id', 'asc')
            ->get();
        }
        else{
            //$asignacion=AsignacionCursoMateria::where('id','=',$buscar)->get();
            $s=DB::table('asignacionmateriacurso')
            ->join('materia', 'codMateria', '=', 'materia.id')
            ->join('asignaciongestioncurso', 'codCursoGestion', '=', 'asignaciongestioncurso.id')
            ->join('gestion', 'codGestion', '=', 'gestion.id')
            ->join('curso', 'codCurso', '=', 'curso.id')
            ->join('paralelo', 'codParalelo', '=', 'paralelo.id')
            ->join('docente', 'codDocente', '=', 'docente.id')
            ->select('asignacionmateriacurso.id',  
                        'asignaciongestioncurso.id as codCursoGestion', 
                        'curso.nombre as nombreCurso', 
                        'gestion.año as gestionCurso',
                        'paralelo.nombre as nombreParalelo',

                        'materia.id as codMateria', 
                        'materia.nombre as nombreMateria', 

                        'docente.id as codDocente',
                        'docente.nombre as nombreDocente',
                        'docente.apellido as apellidoDocente'
                    )
            ->orderBy('id', 'asc')
            ->where('curso.nombre','like','%'.$buscar.'%')
            ->get();
        }
        
        return $s;
    }

    public function store(Request $request){
        $asignacion = new AsignacionCursoMateria;
        $asignacion->codCursoGestion=$request->codCursoGestion;
        $asignacion->codMateria=$request->codMateria;
        $asignacion->codDocente=$request->codDocente;
        $asignacion->save();
    }

    public function update(Request $request){
        $asignacion = AsignacionCursoMateria::findOrFail($request->id);
        $asignacion->codCursoGestion=$request->codCursoGestion;
        $asignacion->codMateria=$request->codMateria;
        $asignacion->codDocente=$request->codDocente;
        $asignacion->save();
    }

    public function delete(Request $request){
        $asignacion = AsignacionCursoMateria::findOrFail($request->id);
        $asignacion->delete();
    }

    public function buscarMateriaCursoPorId(Request $request){
        $buscar= $request->buscar;
        if($buscar==''){
            $s=DB::table('asignacionmateriacurso')
            ->join('materia', 'codMateria', '=', 'materia.id')
            ->join('docente', 'codDocente', '=', 'docente.id')
            ->join('asignaciongestioncurso', 'codCursoGestion', '=', 'asignaciongestioncurso.id')
            ->join('gestion', 'codGestion', '=', 'gestion.id')
            ->join('curso', 'codCurso', '=', 'curso.id')
            ->join('paralelo', 'codParalelo', '=', 'paralelo.id')
            ->select('asignacionmateriacurso.id',
            'materia.id as codMateria',
            'materia.nombre as Materia',
            'docente.id as codDocente',
            'docente.nombre as Docente',
            'asignaciongestioncurso.id as codCursoGestion',
            'curso.nombre as Curso', 
            'gestion.año as Gestion',
            'paralelo.nombre as Paralelo'
            )
            ->orderBy('id', 'asc')
            ->get();
        }

        else{
            $s=DB::table('asignacionmateriacurso')
            ->join('materia', 'codMateria', '=', 'materia.id')
            ->join('docente', 'codDocente', '=', 'docente.id')
            ->join('asignaciongestioncurso', 'codCursoGestion', '=', 'asignaciongestioncurso.id')
            ->join('gestion', 'codGestion', '=', 'gestion.id')
            ->join('curso', 'codCurso', '=', 'curso.id')
            ->join('paralelo', 'codParalelo', '=', 'paralelo.id')
            ->select('asignacionmateriacurso.id',
            'materia.id as codMateria',
            'materia.nombre as Materia',
            'docente.id as codDocente',
            'docente.nombre as Docente',
            'asignaciongestioncurso.id as codCursoGestion',
            'curso.nombre as Curso', 
            'gestion.año as Gestion',
            'paralelo.nombre as Paralelo'
            )
            ->where('asignacionmateriacurso.id','=', $buscar)
            ->orderBy('id', 'asc')
            ->get();
        }
        return $s;
    }
}

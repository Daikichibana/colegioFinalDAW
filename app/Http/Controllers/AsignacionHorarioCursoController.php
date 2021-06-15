<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AsignacionHorarioCurso;
use DB;

class AsignacionHorarioCursoController extends Controller
{
    public function index(Request $request){
        $buscar= $request->buscar;
        if($buscar==0){
            $s=DB::table('asignacionhorariocurso')
            ->join('aula', 'codAula', '=', 'aula.id')
            ->join('horario', 'codHorario', '=', 'horario.id')
            ->join('turno', 'codTurno', '=', 'turno.id')
            ->join('asignacionmateriacurso', 'codMateriacurso', '=', 'asignacionmateriacurso.id')
            ->join('materia', 'codMateria', '=', 'materia.id')
            ->join('asignaciongestioncurso', 'codCursoGestion', '=', 'asignaciongestioncurso.id')
            ->join('gestion', 'codGestion', '=', 'gestion.id')
            ->join('curso', 'codCurso', '=', 'curso.id')
            ->join('paralelo', 'codParalelo', '=', 'paralelo.id')
            ->join('docente', 'codDocente', '=', 'docente.id')
            ->select('asignacionhorariocurso.id as Id',
            'horario.id as codHorario',
            'horario.horaInicio as Ini',
            'horario.horaFinalizacion as Fin',
            'horario.dia as Dia',
            'turno.nombre as Turno',
            'aula.id as codAula',
            'aula.descripcion as Des',
            'aula.capacidad as Cap',
            'asignacionmateriacurso.id as codMateriacurso',
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
            $s=DB::table('asignacionhorariocurso')
            ->join('aula', 'codAula', '=', 'aula.id')
            ->join('horario', 'codHorario', '=', 'horario.id')
            ->join('turno', 'codTurno', '=', 'turno.id')
            ->join('asignacionmateriacurso', 'codMateriacurso', '=', 'asignacionmateriacurso.id')
            ->join('materia', 'codMateria', '=', 'materia.id')
            ->join('asignaciongestioncurso', 'codCursoGestion', '=', 'asignaciongestioncurso.id')
            ->join('gestion', 'codGestion', '=', 'gestion.id')
            ->join('curso', 'codCurso', '=', 'curso.id')
            ->join('paralelo', 'codParalelo', '=', 'paralelo.id')
            ->join('docente', 'codDocente', '=', 'docente.id')
            ->select('asignacionhorariocurso.id as Id',
            'horario.id as codHorario',
            'horario.horaInicio as Ini',
            'horario.horaFinalizacion as Fin',
            'horario.dia as Dia',
            'turno.nombre as Turno',
            'aula.id as codAula',
            'aula.descripcion as Des',
            'aula.capacidad as Cap',
            'asignacionmateriacurso.id as codMateriacurso',
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
            ->where('curso.nombre','like','%'.$buscar.'%')
            ->get();
        }
        return $s;
    }

    public function store(Request $request){
        $asignacion = new AsignacionHorarioCurso;
        $asignacion->codMateriacurso=$request->codMateriacurso;
        $asignacion->codHorario=$request->codHorario;
        $asignacion->codAula=$request->codAula;
        $asignacion->save();
    }

    public function update(Request $request){
        $asignacion = AsignacionHorarioCurso::findOrFail($request->id);
        $asignacion->codMateriacurso=$request->codMateriacurso;
        $asignacion->codHorario=$request->codHorario;
        $asignacion->codAula=$request->codAula;
        $asignacion->save();
    }

    public function delete(Request $request){
        $asignacion = AsignacionHorarioCurso::findOrFail($request->id);
        $asignacion->delete();
    }
}

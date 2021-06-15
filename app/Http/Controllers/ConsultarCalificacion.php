<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use DB;

class ConsultarCalificacion extends Controller
{
    public function consultarCalificacion(Request $request){
        $buscar= $request->buscar;
        $id= $request->buscar2;
        $s=DB::table('detallecalificacion')->join('bimestre', 'codBimestre', '=', 'bimestre.id')->join('calificacion', 'codCalificacion', '=', 'calificacion.id')->join('asignacionestudiantecurso', 'codEstudianteCurso', '=', 'asignacionestudiantecurso.id')->join('estudiante', 'codEstudiante', '=', 'estudiante.id')->join('asignacionmateriacurso', 'codMateriaCurso', '=', 'asignacionmateriacurso.id')->join('materia', 'codMateria', '=', 'materia.id')->join('asignaciongestioncurso', 'codCursoGestion', '=', 'asignaciongestioncurso.id')->join('gestion', 'codGestion', '=', 'gestion.id')->select('materia.nombre as Materia','calificacion.observacion as Obs','gestion.año as Gestion','detallecalificacion.notaSer as Ser','detallecalificacion.notaSaber as Saber','detallecalificacion.notaHacer as Hacer','detallecalificacion.notaDecidir as Decidir','bimestre.bimestre as Bimestre')->where('estudiante.id','=',$id)->where('año','=',$buscar)->get();
        return $s;
    }
    public function buscarEstudiante(Request $request){
        $buscar= $request->buscar;
        $estudiante=Estudiante::where('idUsuario','=', $buscar)->get();
        return $estudiante;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calificacion;
use DB;

class CalificacionController extends Controller
{
    public function index(Request $request){
        $buscar= $request->buscar;
        if($buscar==''){
            $calificacion=DB::table('detallecalificacion')->join('bimestre', 'codBimestre', '=', 'bimestre.id')->join('calificacion', 'codCalificacion', '=', 'calificacion.id')->join('asignacionestudiantecurso', 'codEstudianteCurso', '=', 'asignacionestudiantecurso.id')->join('estudiante', 'codEstudiante', '=', 'estudiante.id')->join('asignacionmateriacurso', 'codMateriaCurso', '=', 'asignacionmateriacurso.id')->join('materia', 'codMateria', '=', 'materia.id')->join('asignaciongestioncurso', 'codCursoGestion', '=', 'asignaciongestioncurso.id')->join('gestion', 'codGestion', '=', 'gestion.id')->select('estudiante.nombre as Estudiante','materia.nombre as Materia','calificacion.observacion as Obs','gestion.año as Gestion','detallecalificacion.notaSer as Ser','detallecalificacion.notaSaber as Saber','detallecalificacion.notaHacer as Hacer','detallecalificacion.notaDecidir as Decidir','bimestre.bimestre as Bimestre')->get();
            return $calificacion;            
        }
        else{
            $calificacion=DB::table('detallecalificacion')->join('bimestre', 'codBimestre', '=', 'bimestre.id')->join('calificacion', 'codCalificacion', '=', 'calificacion.id')->join('asignacionestudiantecurso', 'codEstudianteCurso', '=', 'asignacionestudiantecurso.id')->join('estudiante', 'codEstudiante', '=', 'estudiante.id')->join('asignacionmateriacurso', 'codMateriaCurso', '=', 'asignacionmateriacurso.id')->join('materia', 'codMateria', '=', 'materia.id')->join('asignaciongestioncurso', 'codCursoGestion', '=', 'asignaciongestioncurso.id')->join('gestion', 'codGestion', '=', 'gestion.id')->select('estudiante.nombre as Estudiante','materia.nombre as Materia','calificacion.observacion as Obs','gestion.año as Gestion','detallecalificacion.notaSer as Ser','detallecalificacion.notaSaber as Saber','detallecalificacion.notaHacer as Hacer','detallecalificacion.notaDecidir as Decidir','bimestre.bimestre as Bimestre')->where('estudiante.nombre','=',$buscar)->get();
            return $calificacion;
        }
    }
    public function listar(Request $request){
        $id = $request->id;
        $calificacion=DB::table('detallecalificacion')->join('bimestre', 'codBimestre', '=', 'bimestre.id')->join('calificacion', 'codCalificacion', '=', 'calificacion.id')->join('asignacionestudiantecurso', 'codEstudianteCurso', '=', 'asignacionestudiantecurso.id')->join('estudiante', 'codEstudiante', '=', 'estudiante.id')->join('asignacionmateriacurso', 'codMateriaCurso', '=', 'asignacionmateriacurso.id')->join('materia', 'codMateria', '=', 'materia.id')->join('asignaciongestioncurso', 'codCursoGestion', '=', 'asignaciongestioncurso.id')->join('gestion', 'codGestion', '=', 'gestion.id')->select('estudiante.nombre as Estudiante','materia.nombre as Materia','calificacion.observacion as Obs','gestion.año as Gestion','detallecalificacion.notaSer as Ser','detallecalificacion.notaSaber as Saber','detallecalificacion.notaHacer as Hacer','detallecalificacion.notaDecidir as Decidir','bimestre.bimestre as Bimestre')->where('detallecalificacion.id','=',$id)->get();
        return ['detallecalificacion'=>$calificacion];  
    }
    public function update(Request $request){
        $calificacion= DetalleCalificacion::findOrFail($request->id); 
        $calificacion->notaSer = $request->notaSer;
        $calificacion->notaSaber = $request->notaSaber;
        $calificacion->notaHacer = $request->notaHacer;
        $calificacion->notaDecidir = $request->notaDecidir;
        $calificacion->save();
    }
    public function indexDetalle(Request $request){
        $buscar=$request->buscar;
        $s=DB::table('detallecalificacion')->join('bimestre', 'codBimestre', '=', 'bimestre.id')->join('calificacion', 'codCalificacion', '=', 'calificacion.id')->join('asignacionestudiantecurso', 'codEstudianteCurso', '=', 'asignacionestudiantecurso.id')->join('estudiante', 'codEstudiante', '=', 'estudiante.id')->join('asignacionmateriacurso', 'codMateriaCurso', '=', 'asignacionmateriacurso.id')->join('materia', 'codMateria', '=', 'materia.id')->join('asignaciongestioncurso', 'codCursoGestion', '=', 'asignaciongestioncurso.id')->join('gestion', 'codGestion', '=', 'gestion.id')->select('detallecalificacion.id as id','materia.nombre as Materia','calificacion.observacion as Obs','gestion.año as Gestion','detallecalificacion.notaSer as Ser','detallecalificacion.notaSaber as Saber','detallecalificacion.notaHacer as Hacer','detallecalificacion.notaDecidir as Decidir','bimestre.bimestre as Bimestre')->where('estudiante.nombre','like','%'.$buscar.'%')->get();
        return $s;
    }
    public function buscarEstCur(Request $request){
        
    }

}

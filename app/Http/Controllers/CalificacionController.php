<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calificacion;
use App\Models\DetalleCalificacion;
use DB;

class CalificacionController extends Controller
{
    public function index(Request $request){
        $buscar= $request->buscar;
        if($buscar==''){
            $calificacion=DB::table('detallecalificacion')->join('bimestre', 'codBimestre', '=', 'bimestre.id')->join('calificacion', 'codCalificacion', '=', 'calificacion.id')->join('asignacionestudiantecurso', 'codEstudianteCurso', '=', 'asignacionestudiantecurso.id')->join('estudiante', 'codEstudiante', '=', 'estudiante.id')->join('asignacionmateriacurso', 'codMateriaCurso', '=', 'asignacionmateriacurso.id')->join('materia', 'codMateria', '=', 'materia.id')->join('asignaciongestioncurso', 'codCursoGestion', '=', 'asignaciongestioncurso.id')->join('gestion', 'codGestion', '=', 'gestion.id')->select('estudiante.nombre as Estudiante','materia.nombre as Materia','calificacion.observacion as observacion','gestion.año as Gestion','detallecalificacion.notaSer as Ser','detallecalificacion.notaSaber as Saber','detallecalificacion.notaHacer as Hacer','detallecalificacion.notaDecidir as Decidir','bimestre.bimestre as Bimestre')->get();
            return $calificacion;            
        }
        else{
            $calificacion=DB::table('detallecalificacion')->join('bimestre', 'codBimestre', '=', 'bimestre.id')->join('calificacion', 'codCalificacion', '=', 'calificacion.id')->join('asignacionestudiantecurso', 'codEstudianteCurso', '=', 'asignacionestudiantecurso.id')->join('estudiante', 'codEstudiante', '=', 'estudiante.id')->join('asignacionmateriacurso', 'codMateriaCurso', '=', 'asignacionmateriacurso.id')->join('materia', 'codMateria', '=', 'materia.id')->join('asignaciongestioncurso', 'codCursoGestion', '=', 'asignaciongestioncurso.id')->join('gestion', 'codGestion', '=', 'gestion.id')->select('estudiante.nombre as Estudiante','materia.nombre as Materia','calificacion.observacion as observacion','gestion.año as Gestion','detallecalificacion.notaSer as Ser','detallecalificacion.notaSaber as Saber','detallecalificacion.notaHacer as Hacer','detallecalificacion.notaDecidir as Decidir','bimestre.bimestre as Bimestre')->where('estudiante.nombre','=',$buscar)->get();
            return $calificacion;
        }
    }
    public function store(Request $request){
    try {
        DB::beginTransaction();

        $calificacion = new Calificacion;
        $calificacion->observacion = $request->observacion;
        $calificacion->codEstudianteCurso = $request->codEstudianteCurso;
        $calificacion->save();

        $detalles=$request->data;
        foreach($detalles as $ep=>$det){
            $detalles= new DetalleCalificacion;
            $detalles->codCalificacion=$calificacion->id;
            $detalles->notaSer=$det["notaSer"];
            $detalles->notaSaber=$det["notaSaber"];
            $detalles->notaHacer=$det["notaHacer"];
            $detalles->notaDecidir=$det["notaDecidir"];
            $detalles->codBimestre=$det["idBimestre"];
            $detalles->save();
        }
        DB::commit();
        return['id'=>$calificacion->id];

    }   catch(Exception $e){   
    DB::rollBack();}
    }
    public function listar(Request $request){
        $id = $request->id;
        $calificacion=DB::table('detallecalificacion')->join('bimestre', 'codBimestre', '=', 'bimestre.id')->join('calificacion', 'codCalificacion', '=', 'calificacion.id')->join('asignacionestudiantecurso', 'codEstudianteCurso', '=', 'asignacionestudiantecurso.id')->join('estudiante', 'codEstudiante', '=', 'estudiante.id')->join('asignacionmateriacurso', 'codMateriaCurso', '=', 'asignacionmateriacurso.id')->join('materia', 'codMateria', '=', 'materia.id')->join('asignaciongestioncurso', 'codCursoGestion', '=', 'asignaciongestioncurso.id')->join('gestion', 'codGestion', '=', 'gestion.id')->select('estudiante.nombre as Estudiante','materia.nombre as Materia','calificacion.observacion as Obs','gestion.año as Gestion','detallecalificacion.notaSer as Ser','detallecalificacion.notaSaber as Saber','detallecalificacion.notaHacer as Hacer','detallecalificacion.notaDecidir as Decidir','bimestre.bimestre as Bimestre')->where('detallecalificacion.id','=',$id)->get();
        return ['detallecalificacion'=>$calificacion];  
    }
    
    public function indexDetalle(Request $request){
        $buscar=$request->buscar;
        if($buscar==''){
            
        $s=DB::table('detallecalificacion')->join('bimestre', 'codBimestre', '=', 'bimestre.id')->join('calificacion', 'codCalificacion', '=', 'calificacion.id')->join('asignacionestudiantecurso', 'codEstudianteCurso', '=', 'asignacionestudiantecurso.id')->join('estudiante', 'codEstudiante', '=', 'estudiante.id')->join('asignacionmateriacurso', 'codMateriaCurso', '=', 'asignacionmateriacurso.id')->join('materia', 'codMateria', '=', 'materia.id')->join('asignaciongestioncurso', 'codCursoGestion', '=', 'asignaciongestioncurso.id')->join('gestion', 'codGestion', '=', 'gestion.id')->select('detallecalificacion.id as id','materia.nombre as Materia','calificacion.observacion as Obs','gestion.año as Gestion','detallecalificacion.notaSer as Ser','detallecalificacion.notaSaber as Saber','detallecalificacion.notaHacer as Hacer','detallecalificacion.notaDecidir as Decidir','bimestre.bimestre as Bimestre','estudiante.nombre as estudiante','estudiante.apellido as estuapell')->get();
        return $s;

        }
        else{
            
        $s=DB::table('detallecalificacion')->join('bimestre', 'codBimestre', '=', 'bimestre.id')->join('calificacion', 'codCalificacion', '=', 'calificacion.id')->join('asignacionestudiantecurso', 'codEstudianteCurso', '=', 'asignacionestudiantecurso.id')->join('estudiante', 'codEstudiante', '=', 'estudiante.id')->join('asignacionmateriacurso', 'codMateriaCurso', '=', 'asignacionmateriacurso.id')->join('materia', 'codMateria', '=', 'materia.id')->join('asignaciongestioncurso', 'codCursoGestion', '=', 'asignaciongestioncurso.id')->join('gestion', 'codGestion', '=', 'gestion.id')->select('detallecalificacion.id as id','materia.nombre as Materia','calificacion.observacion as Obs','gestion.año as Gestion','detallecalificacion.notaSer as Ser','detallecalificacion.notaSaber as Saber','detallecalificacion.notaHacer as Hacer','detallecalificacion.notaDecidir as Decidir','bimestre.bimestre as Bimestre','estudiante.nombre as estudiante','estudiante.apellido as estuapell')->where('estudiante.nombre','like','%'.$buscar.'%')->get();
        return $s;

        }
    }
    public function indexEstuCur(Request $request){
        $buscar= $request->buscar;
        if($buscar==0){
          
            $s=DB::table('asignacionestudiantecurso')->join('estudiante', 'codEstudiante', '=', 'estudiante.id')->join('asignacionmateriacurso', 'codMateriaCurso', '=', 'asignacionmateriacurso.id')->join('materia', 'codMateria', '=', 'materia.id')->join('docente', 'codDocente', '=', 'docente.id')->join('asignaciongestioncurso', 'codCursoGestion', '=', 'asignaciongestioncurso.id')->join('paralelo', 'codParalelo', '=', 'paralelo.id')->join('gestion', 'codGestion', '=', 'gestion.id')->join('curso', 'codCurso', '=', 'curso.id')->select('asignacionestudiantecurso.codMateriaCurso','asignacionestudiantecurso.codEstudiante','asignacionestudiantecurso.id as id','estudiante.nombre as nombre','estudiante.apellido as apellido','curso.nombre as curso','gestion.año as gestion','paralelo.nombre as paralelo','materia.nombre as materia','docente.nombre as Docente')->orderBy('id', 'asc')->get();
        }
        else{
            $s=DB::table('asignacionestudiantecurso')->join('estudiante', 'codEstudiante', '=', 'estudiante.id')->join('asignacionmateriacurso', 'codMateriaCurso', '=', 'asignacionmateriacurso.id')->join('materia', 'codMateria', '=', 'materia.id')->join('docente', 'codDocente', '=', 'docente.id')->join('asignaciongestioncurso', 'codCursoGestion', '=', 'asignaciongestioncurso.id')->join('paralelo', 'codParalelo', '=', 'paralelo.id')->join('gestion', 'codGestion', '=', 'gestion.id')->join('curso', 'codCurso', '=', 'curso.id')->select('asignacionestudiantecurso.codMateriaCurso','asignacionestudiantecurso.codEstudiante','asignacionestudiantecurso.id as Id','estudiante.nombre as nombre','estudiante.apellido as apellido','curso.nombre as Curso','gestion.año as gestion','paralelo.nombre as paralelo','materia.nombre as materia','docente.nombre as Docente')
             ->where('estudiante.nombre','=',$buscar)
             ->orderBy('id','asc')
             ->get();
        }
        return $s;
    }
    public function obtenerCabecera(Request $request){
        $id=$request->id;
        $calificacion=DB::table('calificacion')->join('asignacionestudiantecurso', 'codEstudianteCurso', '=', 'asignacionestudiantecurso.id')->join('estudiante', 'codEstudiante', '=', 'estudiante.id')->join('asignacionmateriacurso', 'codMateriaCurso', '=', 'asignacionmateriacurso.id')->join('materia', 'codMateria', '=', 'materia.id')->join('asignaciongestioncurso', 'codCursoGestion', '=', 'asignaciongestioncurso.id')->join('gestion', 'codGestion', '=', 'gestion.id')->join('curso','codCurso','=','curso.id')->select('asignacionestudiantecurso.id as idAEstudianteCurso','calificacion.id as id','curso.nombre as curso','estudiante.nombre as Estudiante','estudiante.apellido as estuapell','materia.nombre as Materia','calificacion.observacion as observacion','gestion.año as Gestion')->where('calificacion.id','=',$id)->orderBy('id','asc')->get();
        return $calificacion;            
    
    }
    public function obtenerDetalles(Request $request){
        $id=$request->id;
        $s=DB::table('detallecalificacion')->join('bimestre', 'codBimestre', '=', 'bimestre.id')->join('calificacion', 'codCalificacion', '=', 'calificacion.id')->join('asignacionestudiantecurso', 'codEstudianteCurso', '=', 'asignacionestudiantecurso.id')->join('estudiante', 'codEstudiante', '=', 'estudiante.id')->join('asignacionmateriacurso', 'codMateriaCurso', '=', 'asignacionmateriacurso.id')->join('materia', 'codMateria', '=', 'materia.id')->join('asignaciongestioncurso', 'codCursoGestion', '=', 'asignaciongestioncurso.id')->join('gestion', 'codGestion', '=', 'gestion.id')->select('detallecalificacion.id as id','detallecalificacion.codCalificacion as idCalificacion','detallecalificacion.notaSer as Ser','detallecalificacion.notaSaber as Saber','detallecalificacion.notaHacer as Hacer','detallecalificacion.notaDecidir as Decidir','bimestre.bimestre as Bimestre')->where('detallecalificacion.id','=',$id)->get();
        return $s;

    }

}

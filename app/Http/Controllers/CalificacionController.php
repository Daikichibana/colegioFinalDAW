<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calificacion;
use DB;

class CalificacionController extends Controller
{
    public function cabecera(Request $request){
        $buscar= $request->buscar;
        if($buscar==''){
            $calificacion = DB::table('calificacion')->join('asignacionestudiantecurso','codEstudiante','=','asignacionestudiantecurso.id')->join('estudiante','asignacionestudiantecurso.codEstudiante', '=', 'estudiante.id')->join('asignacionmateriacurso','asignacionestudiantecurso.codMateriaCurso','=','asignacionmateriacurso.id')->join('materia','asignacionmateriacurso.codMateria','=','materia.id')->join('asignaciongestioncurso','asignacionmateriacurso.codCursoGestion','=','asignaciongestioncurso.id')->join('curso','asignaciongestioncurso.codCurso','=','curso.id')->select('calificacion.id','calificacion.observacion','calificacion.codEstudianteCurso as idAEstudianteCurso')->get();
        }
        else{
            $calificacion=Calificacion::where('id','=',$buscar)->get();
        }
        
        return $calificacion;
    }

    public function store(Request $request){
        $calificacion = new Calificacion;
        $calificacion->codEstudiante=$request->codEstudiante;
        $calificacion->codMateriaCurso=$request->codCurso;
        $calificacion->save();
    }

    public function update(Request $request){
        $calificacion = Calificacion::findOrFail($request->id);
        $calificacion->codMateriaCurso=$request->codCurso;
        $calificacion->codEstudiante=$request->codEstudiante;
        $calificacion->save();
    }
    public function delete(Request $request){
        $calificacion = Calificacion::findOrFail($request->id);
        $calificacion->delete();
    }
}

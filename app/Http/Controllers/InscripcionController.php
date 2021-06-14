<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscripcion;
use App\Models\DetalleInscripcion;
use DB;
class InscripcionController extends Controller
{
    public function index(Request $request){
        $buscar = $request->buscar;
        if($buscar==''){
            $inscripcion = DB::table('inscripcion')
            ->join('estudiante','inscripcion.codEstudiante', '=', 'estudiante.id')
            ->join('asignaciongestioncurso','inscripcion.codACursoGestion', '=', 'asignaciongestioncurso.id')
            ->join('curso','asignaciongestioncurso.codCurso', '=', 'curso.id')
            ->join('gestion','asignaciongestioncurso.codGestion', '=', 'gestion.id')
            ->select('inscripcion.id','inscripcion.fecha','inscripcion.codACursoGestion as idCurso',
            'curso.nombre as cursoNombre','gestion.año as cursoGestion','estudiante.id as idEstudiante', 
            'estudiante.nombre as estudianteNombre','estudiante.apellido as estudianteApellido')
            ->orderBy('inscripcion.id','desc')
            ->get();
        }
        else{
            $inscripcion = DB::table('inscripcion')
            ->join('estudiante','inscripcion.codEstudiante', '=', 'estudiante.id')
            ->join('asignaciongestioncurso','inscripcion.codACursoGestion', '=', 'asignaciongestioncurso.id')
            ->join('curso','asignaciongestioncurso.codCurso', '=', 'curso.id')
            ->join('gestion','asignaciongestioncurso.codGestion', '=', 'gestion.id')
            ->select('inscripcion.id','inscripcion.fecha','inscripcion.codACursoGestion as idCurso',
            'curso.nombre as cursoNombre','gestion.año as cursoGestion','estudiante.id as idEstudiante', 
            'estudiante.nombre as estudianteNombre', 'estudiante.apellido as estudianteApellido')
            ->where('estudiante.nombre','like','%'.$buscar.'%')
            ->orderBy('inscripcion.id','desc')
            ->get();
        }
        return $inscripcion;
    }

    public function store(Request $request){
        try{
            DB::beginTransaction();

            $inscripcion = new Inscripcion;
            $inscripcion->fecha=$request->fecha;
            $inscripcion->codACursoGestion=$request->idCurso;
            $inscripcion->codEstudiante=$request->idEstudiante;
            $inscripcion->save();

            $detalles = $request->data;
            foreach($detalles as $ep=>$det){
                $detalle = new DetalleInscripcion();
                $detalle->codInscripcion=$inscripcion->id;
                $detalle->codApoderado=$det['idApoderado'];
                $detalle->relacion=$det['relacion'];
                $detalle->save();
            }
            DB::commit();
            return[
                'id'=>$inscripcion->id
            ];
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function update(Request $request){
        try{
            DB::beginTransaction();
            $inscripcion = Inscripcion::findOrFail($request->id);
            $inscripcion->fecha=$request->fecha;
            $inscripcion->codACursoGestion=$request->idCurso;
            $inscripcion->codEstudiante=$request->idEstudiante;
            $inscripcion->save();

            $detalles = $request->data;
            foreach($detalles as $ep=>$det){
                $detalle = new DetalleInscripcion();
                $detalle->codInscripcion=$inscripcion->id;
                $detalle->codApoderado=$det['idApoderado'];
                $detalle->relacion=$det['relacion'];
                $detalle->save();
            }
            DB::commit();
            return[
                'id'=>$inscripcion->id
            ];
        } catch (Exception $e){
            DB::rollBack();
        }
    }
    public function delete(Request $request){
        $inscripcion = Inscripcion::findOrFail($request->id);
        $inscripcion->delete();
    }    

    public function deleteDetalle(Request $request){
        $id=$request->id;
        $detalle = DetalleInscripcion::where('detalleinscripcion.codInscripcion','=',$id);
        $detalle->delete();
    }    

    public function obtenerCabecera(Request $request){  
        $id=$request->id;

        $inscripcion = DB::table('inscripcion')
        ->join('estudiante','inscripcion.codEstudiante', '=', 'estudiante.id')
        ->join('asignaciongestioncurso','inscripcion.codACursoGestion', '=', 'asignaciongestioncurso.id')
        ->join('curso','asignaciongestioncurso.codCurso', '=', 'curso.id')
        ->join('gestion','asignaciongestioncurso.codGestion', '=', 'gestion.id')
        ->join('paralelo','asignaciongestioncurso.codParalelo', '=', 'paralelo.id')
        ->select('inscripcion.id','inscripcion.fecha','inscripcion.codACursoGestion as idCurso',
        'curso.nombre as cursoNombre', 'paralelo.nombre as cursoParalelo','gestion.año as cursoGestion','estudiante.id as idEstudiante',
        'estudiante.nombre as estudianteNombre', 'estudiante.apellido as estudianteApellido')
        ->where('inscripcion.id','=',$id)
        ->get();
        return ['inscripcion'=>$inscripcion];
    }

    public function obtenerDetalles(Request $request){
        $id=$request->id;
        $detalle = DetalleInscripcion::join('apoderado','detalleinscripcion.codApoderado','=','apoderado.id')
        ->select('detalleinscripcion.codApoderado', 'detalleinscripcion.relacion', 'apoderado.id as idApoderado', 
        'apoderado.nombre as apoderadoNombre', 'apoderado.apellido as apoderadoApellido', 'apoderado.telefono as apoderadoTelefono')
        ->where('detalleinscripcion.codInscripcion','=',$id)
        ->get();
        return['detalle' => $detalle];
    }
}

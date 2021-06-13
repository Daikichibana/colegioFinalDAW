<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AsignacionMateriaCurso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('asignacionMateriaCurso', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('codMateria');
            $table->unsignedBigInteger('codCursoGestion');
            $table->unsignedBigInteger('codDocente');
        
            $table->foreign('codMateria')->references('id')->on('materia');
            $table->foreign('codCursoGestion')->references('id')->on('asignacionGestionCurso');
            $table->foreign('codDocente')->references('id')->on('docente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('asignacionMateriaCurso');
    }
}

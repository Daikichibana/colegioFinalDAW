<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AsignacionHorarioCurso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('asignacionHorarioCurso', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('codHorario');
            $table->unsignedBigInteger('codMateriacurso');
            $table->unsignedBigInteger('CodAula');
        
            $table->foreign('codHorario')->references('id')->on('horario');
            $table->foreign('codMateriacurso')->references('id')->on('asignacionMateriaCurso');
            $table->foreign('codAula')->references('id')->on('aula');
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
        Schema::dropIfExists('asignacionHorarioCurso');
    }
}

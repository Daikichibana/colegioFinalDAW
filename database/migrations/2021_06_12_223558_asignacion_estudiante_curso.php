<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AsignacionEstudianteCurso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('asignacionEstudianteCurso', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('codEstudiante');
            $table->unsignedBigInteger('codMateriaCurso');
        
            $table->foreign('codEstudiante')->references('id')->on('estudiante');
            $table->foreign('codMateriaCurso')->references('id')->on('asignacionMateriaCurso');
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
        Schema::dropIfExists('asignacionEstudianteCurso');
    }
}

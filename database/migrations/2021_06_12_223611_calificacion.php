<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Calificacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('calificacion', function (Blueprint $table) {
            $table->id();
            $table->string('observacion', 40);
            $table->unsignedBigInteger('codEstudianteCurso');
            
            $table->foreign('codEstudianteCurso')->references('id')->on('asignacionEstudianteCurso');
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
        Schema::dropIfExists('calificacion');
    }
}

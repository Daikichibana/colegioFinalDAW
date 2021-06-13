<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AsignacionGestionCurso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('asignacionGestionCurso', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('codCurso');
            $table->unsignedBigInteger('codGestion');
            $table->unsignedBigInteger('codParalelo');
        
            $table->foreign('codCurso')->references('id')->on('curso');
            $table->foreign('codGestion')->references('id')->on('gestion');
            $table->foreign('codParalelo')->references('id')->on('paralelo');
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
        Schema::dropIfExists('');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Horario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('horario', function (Blueprint $table) {
            $table->id();
            $table->time('horaInicio');
            $table->time('horaFinalizacion');
            $table->string('dia', 40);
            $table->unsignedBigInteger('codTurno');
           
            $table->foreign('codTurno')->references('id')->on('turno');
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
        Schema::dropIfExists('horario');
    }
}

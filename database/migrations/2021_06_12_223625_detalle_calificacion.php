<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetalleCalificacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('detalleCalificacion', function (Blueprint $table) {
            $table->id();
            $table->integer('notaSer');
            $table->integer('notaSaber');
            $table->integer('notaHacer');
            $table->integer('notaDecidir');
            $table->unsignedBigInteger('codCalificacion');
            $table->unsignedBigInteger('codBimestre');

            $table->foreign('codCalificacion')->references('id')->on('calificacion');
            $table->foreign('codBimestre')->references('id')->on('bimestre');
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
        Schema::dropIfExists('detalleCalificacion');
    }
}

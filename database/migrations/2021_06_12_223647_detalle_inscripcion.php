<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetalleInscripcion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('detalleInscripcion', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('codApoderado');
            $table->unsignedBigInteger('codInscripcion');
            $table->string('relacion', 40);

            $table->foreign('codApoderado')->references('id')->on('apoderado');
            $table->foreign('codInscripcion')->references('id')->on('inscripcion');
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
        Schema::dropIfExists('detalleInscripcion');
    }
}

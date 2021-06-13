<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Apoderado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('apoderado', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 40);
            $table->string('apellido', 40);
            $table->integer('telefono');
            $table->string('direccion', 150);
            $table->date('fechaNacimiento');
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
        Schema::dropIfExists('apoderado');
    }
}

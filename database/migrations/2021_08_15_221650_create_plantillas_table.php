<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantillas', function (Blueprint $table) {
            $table->id('id_plantilla');
            $table->string('nombre', 30);
            $table->text('descripcion', 800);
            $table->date('fecha_creacion');
            $table->date('fecha_finalizacion');
            $table->string('ciudad', 50);
            $table->foreignId('id_proceso')->references('id_proceso')->on('procesos')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plantillas');
    }
}

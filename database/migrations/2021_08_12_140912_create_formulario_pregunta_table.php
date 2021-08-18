<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateFormularioPreguntaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formulario_pregunta', function (Blueprint $table) {
            $table->id('id_formulario_pregunta');
            $table->foreignId('id_obligacion')->references('id_obligacion')->on('obligaciones')->onUpdate('cascade');
            $table->foreignId('id_pregunta')->references('id_pregunta')->on('preguntas')->onUpdate('cascade');
            $table->foreignId('id_formulario')->references('id_formulario')->on('formularios')->onUpdate('cascade');
            // $table->timestamps();
        });

        DB::table('formulario_pregunta')->insert([
            'id_obligacion' => 1, 'id_pregunta' => 1, 'id_formulario' => 1
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formulario_pregunta');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePreguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preguntas', function (Blueprint $table) {
            $table->id('id_pregunta');
            $table->string('pregunta_actividad', 200);
            $table->string('pregunta_evidencia', 200);
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });

        DB::table('preguntas')->insert([
            'pregunta_actividad' => 'Pregunta actividad Pregunta actividad',
            'pregunta_evidencia' => 'Pregunta evidencia Pregunta evidencia',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preguntas');
    }
}

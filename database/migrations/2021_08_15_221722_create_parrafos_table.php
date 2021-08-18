<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParrafosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parrafos', function (Blueprint $table) {
            $table->id('id_parrafo');
            $table->text('texto');
            $table->integer('numero_parrafo');
            $table->boolean('estado')->default(1);
            $table->foreignId('id_plantilla')->references('id_plantilla')->on('plantillas')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parrafos');
    }
}

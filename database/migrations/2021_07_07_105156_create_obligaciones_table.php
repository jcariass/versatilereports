<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateObligacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obligaciones', function (Blueprint $table) {
            $table->id('id_obligacion');
            $table->text('detalle');
            $table->foreignId('id_proceso')->references('id_proceso')->on('procesos')->onUpdate('cascade');
            $table->date('fecha_creacion');
            $table->date('fecha_vencimiento');
        });

        DB::table('obligaciones')->insert([
            'detalle' => 'Obligacion de prueba Obligacion de prueba Obligacion de prueba Obligacion de prueba',
            'id_proceso' => 1, 'fecha_creacion' => '2021-08-12', 'fecha_vencimiento' => '2021-12-12'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obligaciones');
    }
}

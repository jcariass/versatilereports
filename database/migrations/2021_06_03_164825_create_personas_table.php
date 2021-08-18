<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id('id_persona');
            $table->integer('documento')->unique();
            $table->string('tipo_documento', 5);
            $table->string('nombre', 40);
            $table->string('primer_apellido', 30);
            $table->string('segundo_apellido', 30)->nullable();
            $table->string('correo')->unique();
            $table->string('correo_sena')->nullable()->unique();
            $table->string('celular_uno', 10);
            $table->string('celular_dos', 10)->nullable();
            $table->string('firma')->nullable()->unique();
            $table->boolean('estado')->default(1);
            $table->foreignId('id_municipio')->references('id_municipio')->on('municipios')->onUpdate('cascade');
            $table->timestamps();
        });

        DB::table('personas')->insert([
            'documento' => '123456789',
            'tipo_documento' => 'CC',
            'nombre' => 'Jorge Asdrúbal',
            'primer_apellido' => 'Ortega',
            'correo' => 'jaog.11.2003@gmail.com',
            'celular_uno' => '3116519569',
            'id_municipio' => '21'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}

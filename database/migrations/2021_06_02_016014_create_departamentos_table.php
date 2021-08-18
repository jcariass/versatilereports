<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDepartamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departamentos', function (Blueprint $table) {
            $table->id('id_departamento');
            $table->string('nombre', 70);
            // $table->timestamps();
        });

        DB::table('departamentos')->insert([
            ['nombre' => 'Amazonas'],
            ['nombre' => 'Antioquia'],
            ['nombre' => 'Arauca'],
            ['nombre' => 'Atlantico'],
            ['nombre' => 'Bolívar'],
            ['nombre' => 'Boyacá'],
            ['nombre' => 'Caldas'],
            ['nombre' => 'Caquetá'],
            ['nombre' => 'Casanare'],
            ['nombre' => 'Cauca'],
            ['nombre' => 'Cesar'],
            ['nombre' => 'Chocó'],
            ['nombre' => 'Córdoba'],
            ['nombre' => 'Cundinamarca'],
            ['nombre' => 'Guainía'],
            ['nombre' => 'Guaviare'],
            ['nombre' => 'Huila'],
            ['nombre' => 'La Guajira'],
            ['nombre' => 'Magdalena'],
            ['nombre' => 'Meta'],
            ['nombre' => 'Nariño'],
            ['nombre' => 'Norte de Santander'],
            ['nombre' => 'Putumayo'],
            ['nombre' => 'Quindío'],
            ['nombre' => 'Risaralda'],
            ['nombre' => 'San Andrés y Providencia'],
            ['nombre' => 'Santander'],
            ['nombre' => 'Sucre'],
            ['nombre' => 'Tolima'],
            ['nombre' => 'Valle del Cauca'],
            ['nombre' => 'Vaupés'],
            ['nombre' => 'Vichada']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departamentos');
    }
}

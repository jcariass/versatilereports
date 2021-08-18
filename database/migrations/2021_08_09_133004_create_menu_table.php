<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id('id_menu');
            $table->string('nombre', 100);
            $table->string('url', 100);
            $table->string('icono', 20);
            $table->string('padre');   
            // $table->timestamps();
        });

        DB::table('menu')->insert([
            [   'nombre' => 'Usuarios', 'icono' => 'la la-user', 'url' => '/usuarios' ,'padre' => 'No'    ],
            [   'nombre' => 'Contratistas', 'icono' => 'la la-group', 'url' => '#' ,'padre' => 'No'    ],
            [   'nombre' => 'Entrega de Requerimientos', 'icono' => 'la la-archive', 'url' => '#' ,'padre' => 'No'    ],
            [   'nombre' => 'Revisión de Requerimientos', 'icono' => 'la la-list-alt', 'url' => '#' ,'padre' => 'No'    ],
            [   'nombre' => 'Gestión de Requerimientos', 'icono' => 'la la-database', 'url' => '#' ,'padre' => 'No'    ],
            [   'nombre' => 'Parametrizaciones', 'icono' => 'mbri-extension', 'url' => '#' ,'padre' => 'Si'    ],
            [   'nombre' => 'Gestión de Roles', 'icono' => 'la la-cogs', 'url' => '/roles' ,'padre' => '6'    ],
            [   'nombre' => 'Gestión de Objetos de Contrato', 'icono' => 'la la-cogs', 'url' => '/objetos/contratos' ,'padre' => '6'    ],
            [   'nombre' => 'Gestión de Proceso', 'icono' => 'la la-cogs', 'url' => '/procesos' ,'padre' => '6'    ],
            [   'nombre' => 'Gestión de Obligaciones', 'icono' => 'la la-cogs', 'url' => '/obligaciones' ,'padre' => '6'    ],
            [   'nombre' => 'Gestión de Formularios', 'icono' => 'la la-cogs', 'url' => '/formularios' ,'padre' => '6'    ],
            [   'nombre' => 'Gestión de Centros', 'icono' => 'la la-cogs', 'url' => '/centros' ,'padre' => '6'    ],
            [   'nombre' => 'Gestión de Supervisores', 'icono' => 'la la-cogs', 'url' => '/supervisores' ,'padre' => '6'    ],
            [   'nombre' => 'Gestión de plantillas y parrafos', 'icono' => 'la la-cogs', 'url' => '/plantillas' ,'padre' => '6'    ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}

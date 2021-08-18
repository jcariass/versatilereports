<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMenuRolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_rol', function (Blueprint $table) {
            $table->id('id_menu_rol');
            $table->foreignId('id_menu')->references('id_menu')->on('menu');
            $table->foreignId('id_rol')->references('id_rol')->on('roles');
        });

        DB::table('menu_rol')->insert([
            [   'id_menu' => 1, 'id_rol' => 1   ],
            [   'id_menu' => 2, 'id_rol' => 1   ],
            [   'id_menu' => 3, 'id_rol' => 1   ],
            [   'id_menu' => 4, 'id_rol' => 1   ],
            [   'id_menu' => 5, 'id_rol' => 1   ],
            [   'id_menu' => 6, 'id_rol' => 1   ],
            [   'id_menu' => 7, 'id_rol' => 1   ],
            [   'id_menu' => 8, 'id_rol' => 1   ],
            [   'id_menu' => 9, 'id_rol' => 1   ],
            [   'id_menu' => 10, 'id_rol' => 1   ],
            [   'id_menu' => 11, 'id_rol' => 1   ],
            [   'id_menu' => 12, 'id_rol' => 1   ],
            [   'id_menu' => 13, 'id_rol' => 1   ],
            [   'id_menu' => 14, 'id_rol' => 1   ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_rol');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('tipo_documento', 5);
            $table->integer('documento')->unique();
            $table->string('password');
            $table->boolean('estado')->default(1);
            $table->string('email')->unique();
            $table->foreignId('id_rol')->references('id_rol')->on('roles')->onUpdate('cascade');
            $table->foreignId('id_persona')->references('id_persona')->on('personas')->onUpdate('cascade');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('usuarios')->insert([
            [
                'tipo_documento' => 'CC', 
                'documento' => '123456789', 
                'password' => Hash::make('123456789'), 
                'email' => 'jaog.11.2003@gmail.com', 
                'id_rol' => '1',
                'id_persona' => '1'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

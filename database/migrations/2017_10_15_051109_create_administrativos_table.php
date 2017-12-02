<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdministrativosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrativos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('expediente', 50)->unique();
            $table->string('password', 50);
            $table->string('nombre', 30);
            $table->string('apellido', 30);
            $table->string('foto', 60)->nullable();
            $table->date('fechaDeNacimiento');
            $table->string('edad');
            $table->string('email', 30)->unique();
            $table->bigInteger('numeroDeTelefono')->unique();
            $table->string('lugarDeNacimiento', 50);
            $table->string('direccion', 70);
            $table->string('estadoCivil', 10);
            $table->string('gradoDeEstudios', 20);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administrativos');
    }
}

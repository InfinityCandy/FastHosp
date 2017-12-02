<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('expediente', 50)->unique(); 
            $table->string('password', 50);
            $table->string('nombre', 30);
            $table->string('apellido', 30);
            $table->string('foto', 60)->nullable();
            $table->string('edad');
            $table->date('fechaDeNacimiento');
            $table->string('tipoDeSangre', 3);
            $table->string('email', 30)->unique();
            $table->string('estadoCivil', 10);
            $table->string('gradoDeEstudios', 20);
            $table->string('ocupacion', 30);
            $table->string('lugarDeNacimiento', 50);
            $table->string('direccion', 70);
            $table->string('personaDeConfianza1', 30);
            $table->string('personaDeConfianza2', 30);
            $table->bigInteger('numeroDeTelefono')->unique();
            $table->string('tipoDeAfiliacion', 30);
            $table->string('expedienteDelTrabajador', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}

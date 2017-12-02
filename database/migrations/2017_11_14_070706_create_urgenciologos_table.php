<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrgenciologosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urgenciologos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('urgenciologoExpediente', 50)->unique();
            $table->string('password', 50);
            $table->string('nombre', 30);
            $table->string('apellido', 30);
            $table->string('cedulaProfesional', 100);
            $table->string('institucionDeProcedencia', 100);
            $table->integer('especialidad');
            $table->string('foto', 60)->nullable();
            $table->string('edad');
            $table->date('fechaDeNacimiento');
            $table->string('email', 30)->unique();
            $table->string('estadoCivil', 10);
            $table->string('lugarDeNacimiento', 50);
            $table->string('direccion', 70);
            $table->bigInteger('numeroDeTelefono')->unique();
            $table->string('turno', 15);
            $table->string('consultorioAsignado', 30);
            $table->date('fechaInicioDeLabores');
            $table->date('fechaFinDeLabores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('urgenciologos');
    }
}

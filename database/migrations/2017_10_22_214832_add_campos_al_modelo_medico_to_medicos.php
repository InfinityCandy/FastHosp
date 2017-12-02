<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCamposAlModeloMedicoToMedicos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medicos', function($table) {
            $table->string('expediente', 50)->unique();
            $table->string('password', 50);
            $table->string('nombre', 30);
            $table->string('apellido', 30);
            $table->string('cedulaProfesional', 100);
            $table->string('institucionDeProcedencia', 100);
            $table->integer('especialidad');
            $table->string('turno', 15);
            $table->string('foto', 60)->nullable();
            $table->string('edad');
            $table->date('fechaDeNacimiento');
            $table->string('email', 30)->unique();
            $table->string('estadoCivil', 10);
            $table->string('lugarDeNacimiento', 50);
            $table->string('direccion', 70);
            $table->bigInteger('numeroDeTelefono')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medicos', function($table) {
            $table->dropColumn('expediente'); 
            $table->dropColumn('password');
            $table->dropColumn('nombre');
            $table->dropColumn('apellido');
            $table->dropColumn('cedulaProfesional');
            $table->dropColumn('institucionDeProcedencia');
            $table->dropColumn('especialidad');
            $table->dropColumn('turno');
            $table->dropColumn('foto');
            $table->dropColumn('edad');
            $table->dropColumn('fechaDeNacimiento');
            $table->dropColumn('email');
            $table->dropColumn('estadoCivil');
            $table->dropColumn('lugarDeNacimiento');
            $table->dropColumn('direccion');
            $table->dropColumn('numeroDeTelefono');
        });
    }
}

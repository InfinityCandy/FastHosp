<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitaUrgenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cita_urgencias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('expedientePaciente', 50)->unique(); 
            $table->string('expedienteUrgenciologo', 50);
            $table->string('nombreMedico', 30);
            $table->string('consultorio', 30);
            $table->string('turno', 10);
            $table->date('fechaDeHoy');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cita_urgencias');
    }
}

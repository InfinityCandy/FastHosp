<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelacionesEntreCitasUrgenciasYPacientesMedicosInCitasUrgencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cita_urgencias', function($table) {
            $table->foreign('expedientePaciente')
                            ->references('pacienteExpediente')->on('pacientes')
                            ->onDelete('cascade');
        });
        
        Schema::table('cita_urgencias', function($table) {
            $table->foreign('expedienteUrgenciologo')
                            ->references('urgenciologoExpediente')->on('urgenciologos')
                            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cita_urgencias', function($table) {
            $table->dropForeign(['expedientePaciente']);
            $table->dropForeign(['expedienteUrgenciologo']);
        });
    }
}

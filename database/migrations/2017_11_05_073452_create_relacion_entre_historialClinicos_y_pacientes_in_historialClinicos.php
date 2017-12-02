<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelacionEntreHistorialClinicosYPacientesInHistorialClinicos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('historial_clinicos', function($table) {
            $table->foreign('expedientePaciente')
                            ->references('pacienteExpediente')->on('pacientes')
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
        Schema::table('historial_clinicos', function($table) {
            $table->dropForeign(['expedientePaciente']);
        });
    }
}

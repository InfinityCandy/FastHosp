<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelacionEntreCitasYPacientesInCitas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('citas', function($table) {
            $table->foreign('expedienteDelPaciente')
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
        Schema::table('citas', function($table) {
            $table->dropForeign(['expedienteDelPaciente']);
        });
    }
}

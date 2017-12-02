<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCamposAlModeloCitaToCitas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('citas', function($table) {
            $table->string('expedienteDelPaciente', 50);
            $table->string('nombreDelPaciente', 50);
            $table->string('expedienteDelMedico', 50);
            $table->date('fechaDeCita');
            $table->string('hora', 10);
            $table->string('consultorio', 15);
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
            $table->dropColumn('expedienteDelPaciente'); 
            $table->dropColumn('nombreDelPaciente');
            $table->dropColumn('expedienteDelMedico');
            $table->dropColumn('fechaDeCita');
            $table->dropColumn('hora');
            $table->dropColumn('consultorio');
        });
    }
}

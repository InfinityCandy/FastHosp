<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModEliminarUniqueACamposTelefonoPersonaDeConfianza1Y2ToPaciente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacientes', function($table) {
            $table->dropColumn('telefonoPersonaDeConfianza1');
            $table->dropColumn('telefonoPersonaDeConfianza2');
            $table->bigInteger('telefonoPersonaDeConfianza1');
            $table->bigInteger('telefonoPersonaDeConfianza2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down()
    {
        Schema::table('pacientes', function($table) {
            $table->bigInteger('telefonoPersonaDeConfianza1')->unique()->change(); 
            $table->bigInteger('telefonoPersonaDeConfianza2')->unique()->change();
        });
    }
}

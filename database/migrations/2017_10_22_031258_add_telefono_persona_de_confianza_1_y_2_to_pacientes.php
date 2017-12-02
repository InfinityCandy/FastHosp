<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTelefonoPersonaDeConfianza1Y2ToPacientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacientes', function($table) {
            $table->bigInteger('telefonoPersonaDeConfianza1')->unique(); 
            $table->bigInteger('telefonoPersonaDeConfianza2')->unique();
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
            $table->dropColumn('telefonoPersonaDeConfianza1'); 
            $table->dropColumn('telefonoPersonaDeConfianza2');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModCambioTipoDeCamposTelefonoPersonaDeConfiaza1YTelefonoPersonaDeConfiaza2DeBigIntAStringToPacientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacientes', function($table) {
            $table->string('telefonoPersonaDeConfianza1')->change();
            $table->string('telefonoPersonaDeConfianza2')->change();
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
            $table->bigInteger('telefonoPersonaDeConfianza1')->change();
            $table->bigInteger('telefonoPersonaDeConfianza2')->change();
        });
    }
}

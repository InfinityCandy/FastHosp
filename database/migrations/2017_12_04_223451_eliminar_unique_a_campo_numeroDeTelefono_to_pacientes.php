<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EliminarUniqueACampoNumeroDeTelefonoToPacientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacientes', function($table) {
            $table->dropColumn('numeroDeTelefono');
        });
        
        Schema::table('pacientes', function($table) {
            $table->bigInteger('numeroDeTelefono');
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
            $table->bigInteger('numeroDeTelefono')->unique()->change();
        });
        
    }
}

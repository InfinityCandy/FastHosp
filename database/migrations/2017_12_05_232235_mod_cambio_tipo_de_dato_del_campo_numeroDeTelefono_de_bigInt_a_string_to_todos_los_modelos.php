<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModCambioTipoDeDatoDelCampoNumeroDeTelefonoDeBigIntAStringToTodosLosModelos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacientes', function($table) {
            $table->string('numeroDeTelefono', 30)->change();
        });
        
        Schema::table('administrativos', function($table) {
            $table->string('numeroDeTelefono', 30)->change();
        });
        
        Schema::table('farmaceuticos', function($table) {
            $table->string('numeroDeTelefono', 30)->change();
        });
        
        Schema::table('urgenciologos', function($table) {
            $table->string('numeroDeTelefono', 30)->change();
        });
                      
        Schema::table('medicos', function($table) {
            $table->string('numeroDeTelefono', 30)->change();
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
            $table->bigInteger('numeroDeTelefono')->change();
        });
        
        Schema::table('administrativos', function($table) {
            $table->bigInteger('numeroDeTelefono')->change();
        });
        
        Schema::table('farmaceuticos', function($table) {
            $table->bigInteger('numeroDeTelefono')->change();
        });
        
        Schema::table('urgenciologos', function($table) {
            $table->bigInteger('numeroDeTelefono')->change();
        });
                      
        Schema::table('medicos', function($table) {
            $table->bigInteger('numeroDeTelefono')->change();
        });
    }
}

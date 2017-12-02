<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAlergiasAMedicamentosYAdiccionesToPacientes extends Migration
{
 /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacientes', function($table) {
            $table->string('alergiaAMedicamentos', 400)->nullable(); 
            $table->string('adicciones', 400)->nullable();
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
            $table->dropColumn('alergiaAMedicamentos');
            $table->dropColumn('adicciones');
        });
    }
}

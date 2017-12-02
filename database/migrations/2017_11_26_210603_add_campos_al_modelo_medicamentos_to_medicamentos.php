<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCamposAlModeloMedicamentosToMedicamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medicamentos', function($table) {
            $table->string('expedienteDelPaciente', 50);
            $table->string('medicamentos', 500);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medicamentos', function($table) {
            $table->dropColumn('expedienteDelPaciente'); 
            $table->dropColumn('medicamentos');
        });
    }
}

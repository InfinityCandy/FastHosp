<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModRemoverCampoEspecialidadInUrgenciologos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('urgenciologos', function($table) {
            $table->dropColumn('especialidad'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('urgenciologos', function($table) {
            $table->integer('especialidad');
        });
    }
}

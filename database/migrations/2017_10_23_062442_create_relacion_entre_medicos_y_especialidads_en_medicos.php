<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelacionEntreMedicosYEspecialidadsEnMedicos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medicos', function($table) {
            $table->integer('especialidad')->unsigned()->change();
            $table->foreign('especialidad')
                            ->references('id')->on('especialidads')
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
        Schema::table('medicos', function($table) {
            $table->integer('especialidad')->change();
            $table->dropForeign(['especialidad']);
        });
    }
}

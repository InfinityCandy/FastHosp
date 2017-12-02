<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelacionEntreMedicosYExpedientesInMedicos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medicos', function($table) {
            $table->foreign('medicoExpediente')
                            ->references('expediente')->on('expedientes')
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
            $table->dropForeign(['medicoExpediente']);
        });
    }
}

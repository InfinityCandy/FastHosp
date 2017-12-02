<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelacionEntreCitasYMedicosInCitas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('citas', function($table) {
            $table->foreign('expedienteDelMedico')
                            ->references('medicoExpediente')->on('medicos')
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
        Schema::table('citas', function($table) {
            $table->dropForeign(['expedienteDelMedico']);
        });
    }
}

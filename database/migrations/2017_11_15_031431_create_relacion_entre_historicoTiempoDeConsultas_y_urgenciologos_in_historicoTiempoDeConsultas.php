<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelacionEntreHistoricoTiempoDeConsultasYUrgenciologosInHistoricoTiempoDeConsultas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('historico_tiempo_de_consultas', function($table) {
            $table->foreign('expedienteUrgenciologo')
                            ->references('urgenciologoExpediente')->on('urgenciologos')
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
        Schema::table('urgenciologos', function($table) {
            $table->dropForeign(['expedienteUrgenciologo']);
        });
    }
}

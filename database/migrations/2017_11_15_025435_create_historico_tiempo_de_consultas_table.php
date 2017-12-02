<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricoTiempoDeConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_tiempo_de_consultas', function (Blueprint $table) {
            $table->increments('id');
            $table->time('duracionDeConsulta');
            $table->string('expedienteUrgenciologo', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historico_tiempo_de_consultas');
    }
}

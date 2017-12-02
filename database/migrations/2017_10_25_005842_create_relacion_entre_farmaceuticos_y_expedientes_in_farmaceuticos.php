<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelacionEntreFarmaceuticosYExpedientesInFarmaceuticos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('farmaceuticos', function($table) {
            $table->foreign('farmaceuticoExpediente')
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
        Schema::table('farmaceuticos', function($table) {
            $table->dropForeign(['farmaceuticoExpediente']);
        });
    }
}

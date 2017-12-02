<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelacionEntreAdministrativosYExpedientesInAdministrativos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('administrativos', function($table) {
            $table->foreign('administrativoExpediente')
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
        Schema::table('administrativos', function($table) {
            $table->dropForeign(['administrativoExpediente']);
        });
        
    }
}

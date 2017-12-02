<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeExpedienteAAdministrativoExpedienteInAdministrativos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('administrativos', function($table) {
            $table->renameColumn('expediente', 'administrativoExpediente');
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
            $table->renameColumn('administrativoExpediente', 'expediente');
        });
    }
}

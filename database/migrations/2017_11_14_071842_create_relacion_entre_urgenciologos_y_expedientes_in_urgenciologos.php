<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelacionEntreUrgenciologosYExpedientesInUrgenciologos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('urgenciologos', function($table) {
            $table->foreign('urgenciologoExpediente')
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
        Schema::table('urgenciologos', function($table) {
            $table->dropForeign(['urgenciologoExpediente']);
        });
    }
}

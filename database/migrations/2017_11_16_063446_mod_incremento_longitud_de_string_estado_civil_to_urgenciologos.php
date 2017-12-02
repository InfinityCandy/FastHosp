<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModIncrementoLongitudDeStringEstadoCivilToUrgenciologos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('urgenciologos', function (Blueprint $table) {
             $table->string('estadoCivil', 25)->change();
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('urgenciologos', function (Blueprint $table) {
            $table->string('estadoCivil', 10)->change();
        });
    }
}

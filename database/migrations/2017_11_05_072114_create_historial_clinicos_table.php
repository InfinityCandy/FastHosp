<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistorialClinicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_clinicos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('expedientePaciente', 50)->unique();
            $table->string('peso', 30)->nullable();;
            $table->string('altura', 30)->nullable();;
            $table->string('presionArterial', 30)->nullable();;
            $table->string('temperaturaCorporal', 30)->nullable();;
            $table->longText('historiaClinica')->nullable();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historial_clinicos');
    }
}

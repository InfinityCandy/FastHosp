<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmaceuticosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmaceuticos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('farmaceuticoExpediente', 50)->unique(); 
            $table->string('password', 50); 
            $table->string('nombre', 30);
            $table->string('apellido', 30);
            $table->string('foto', 60)->nullable();
            $table->string('edad');
            $table->date('fechaDeNacimiento');
            $table->string('estadoCivil', 10);
            $table->string('gradoDeEstudios', 20);
            $table->string('direccion', 70);
            $table->string('email', 30)->unique();
            $table->bigInteger('numeroDeTelefono')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farmaceuticos');
    }
}

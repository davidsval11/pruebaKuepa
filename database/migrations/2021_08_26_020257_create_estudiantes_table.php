<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->increments('id');
            $table->string("nombres", 60);
            $table->string("apellidos", 60);
            $table->string("email", 60);
            $table->string("tel", 15);
            $table->integer("programa_id")->unsigned();
            $table->foreign("programa_id")->references("id")->on("programass");
            $table->string("estado_llamada");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estudiantes');
    }
}

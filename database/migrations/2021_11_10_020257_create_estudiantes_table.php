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
            $table->string("nombres", 50);
            $table->string("apellidos", 50);
            $table->string("email", 50);
            $table->string("tel", 10);
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

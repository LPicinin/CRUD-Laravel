<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicoEspecialidadeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MEDICOS_ESPECIALIDADES', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('medico_id')->unsigned();
            $table->bigInteger('especialidade_id')->unsigned();
            $table->timestamps();

            $table->foreign('medico_id')->references('id')->on('MEDICOS')->onDelete('cascade');
            $table->foreign('especialidade_id')->references('id')->on('ESPECIALIDADES')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('MEDICO_ESPECIALIDADES');
    }
}

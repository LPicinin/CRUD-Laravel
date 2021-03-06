<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MEDICOS', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('CRM')->unique();
            $table->string('telefone')->unique();
            $table->string('email')->unique();
            $table->date('dt_cadastro');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('MEDICOS');
    }
}

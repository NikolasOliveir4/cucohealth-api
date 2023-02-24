<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->nullable(false);
            $table->date('data_nascimento')->nullable(false);
            $table->string('cpf_cnpj')->nullable(false);
            $table->integer('tipo')->nullable(false);
            $table->string('email')->nullable(false);
            $table->string('telefone');
            $table->integer('inativo');
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
        Schema::dropIfExists('clientes');
    }
}

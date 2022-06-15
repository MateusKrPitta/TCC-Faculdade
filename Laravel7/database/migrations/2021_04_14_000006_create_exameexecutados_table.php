<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExameexecutadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exameexecutados', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
            $table->unsignedInteger('cliente_id')->comment('ID do cliente');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->unsignedInteger('consulta_id')->nullable()->comment('ID da consulta');
            ///$table->foreign('consulta_id')->references('id')->on('consultas')->onDelete('cascade');
            $table->unsignedBigInteger('medico_id')->nullable()->comment('ID no cadastro de inseminacao');
            $table->foreign('medico_id') ->references('id')->on('medicos')->onDelete('cascade');
            $table->unsignedBigInteger('exame_id')->nullable()->comment('ID do exame');
            $table->foreign('exame_id') ->references('id')->on('exames')->onDelete('cascade');
            
            $table->string('resultado')->comment('Resultado');
            $table->date('data')->comment('Data');
            $table->time('hora')->comment('Horas');
            
            $table->unsignedBigInteger('usuario_id')->nullable()->comment('ID do usuário que realizou a alteração');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status')->nullable()->default('1')->comment('Status do Cliente, 0 inativo e 1 ativo');
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
        Schema::dropIfExists('exameexecutados');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcedimentoexecutadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedimentoexecutados', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
            $table->unsignedInteger('medico_id')->comment('ID do medico');
            $table->foreign('medico_id')->references('id')->on('medicos')->onDelete('cascade');
            $table->unsignedInteger('cliente_id')->comment('ID do cliente');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->unsignedInteger('procedimento_id')->comment('ID do procedimento');
            $table->foreign('procedimento_id')->references('id')->on('procedimentos')->onDelete('cascade');
            
            $table->decimal('valor', 10, 2)->comment('Valor');
            $table->date('data_da_execucao')->comment('Data');
            
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
        Schema::dropIfExists('procedimentoexecutados');
    }
}

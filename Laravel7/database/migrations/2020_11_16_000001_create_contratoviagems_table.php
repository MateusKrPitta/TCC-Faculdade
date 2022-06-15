<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratoviagemsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('contratoviagems', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');

            $table->unsignedInteger('cliente_id')->comment('ID do cliente');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');

            $table->unsignedInteger('veiculo_id')->comment('ID do veiculo');
            $table->foreign('veiculo_id')->references('id')->on('veiculos')->onDelete('cascade');

            $table->string('itinerario')->nullable()->comment('Observações gerais');
            $table->decimal('valor', 10, 2)->nullable()->default('0')->comment('Valor da Contrato de Viagem');
            $table->string('localembarqueinicio')->nullable()->comment('Local de Embarque de início');
            $table->date('datainicio')->nullable()->comment('Data de início da viagem');
            $table->time('horainicio')->nullable()->comment('Hora de início da viagem');
            $table->string('localdedestino')->nullable()->comment('Local de Desembarque de destino');
            $table->string('localembarqueretorno')->nullable()->comment('Local de Embarque de retorno');
            $table->date('dataretorno')->nullable()->comment('Data para iniciar o retorno');
            $table->time('horaretorno')->nullable()->comment('Hora para iniciar o retorno');
            $table->string('observacao')->nullable()->comment('Observações gerais');

            $table->date('datadocontrato')->nullable()->comment('Data do contrato');

            $table->unsignedBigInteger('usuario_id')->nullable()->comment('ID do usuário que realizou a alteração');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status')->nullable()->default('1')->comment('Status do Contratoviagem, 0 inativo e 1 ativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('contratoviagems');
    }

}

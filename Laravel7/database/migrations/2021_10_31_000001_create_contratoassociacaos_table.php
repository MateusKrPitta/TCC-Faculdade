<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratoassociacaosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('contratoassociacaos', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');

            $table->unsignedInteger('cliente_id')->comment('ID do cliente');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');

            $table->unsignedInteger('veiculo_id1')->comment('ID do veiculo');
            $table->foreign('veiculo_id1')->references('id')->on('veiculos')->onDelete('cascade');
            $table->unsignedInteger('veiculo_id2')->nullable()->comment('ID do veiculo');
            $table->foreign('veiculo_id2')->references('id')->on('veiculos')->onDelete('cascade');
            $table->unsignedInteger('veiculo_id3')->nullable()->comment('ID do veiculo');
            $table->foreign('veiculo_id3')->references('id')->on('veiculos')->onDelete('cascade');
            $table->unsignedInteger('veiculo_id4')->nullable()->comment('ID do veiculo');
            $table->foreign('veiculo_id4')->references('id')->on('veiculos')->onDelete('cascade');

            $table->date('data')->nullable()->comment('Data do contrato');
            
            $table->unsignedInteger('termo_id')->nullable()->comment('ID do termo: FIXA, RATEIO, TERCEIROS, OUTROS ');
            $table->decimal('valormensalidade', 10, 2)->nullable()->default('0')->comment('Valor ');
            $table->decimal('valorfundocaixa', 10, 2)->nullable()->default('0')->comment('Valor ');
            $table->decimal('valortotal', 10, 2)->nullable()->default('0')->comment('Valor ');
            $table->decimal('valorterceiro', 10, 2)->nullable()->default('0')->comment('Valor ');
            $table->string('nome')->nullable()->comment('Nome');
            $table->unsignedInteger('formadepagamento_id')->nullable()->comment('ID em Contas a Receber'); // Ordenado após a coluna "status"
            $table->foreign('formadepagamento_id')->references('id')->on('formadepagamentos')->onDelete('cascade');

            $table->text('observacao')->nullable()->comment('Observações gerais');

            $table->unsignedBigInteger('usuario_id')->nullable()->comment('ID do usuário que realizou a alteração');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status')->nullable()->default('1')->comment('Status, 0 inativo e 1 ativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('contratoassociacaos');
    }

}

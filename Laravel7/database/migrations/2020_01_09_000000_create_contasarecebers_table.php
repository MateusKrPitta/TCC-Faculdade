<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContasarecebersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('contasarecebers', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');

            $table->integer('cliente_id')->comment('ID do Cliente no título');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');

            $table->string('descricao')->nullable()->comment('Descrição a que se refere o título');
            $table->decimal('valor', 10, 2)->nullable()->default('0')->comment('Valor do título do Contas a Receber');
            $table->decimal('valordesconto', 10, 2)->nullable()->default('0')->comment('Valor do desconto');
            $table->decimal('valoracrescimo', 10, 2)->nullable()->default('0')->comment('Valor do acréscimo');
            $table->date('vencimento')->nullable()->comment('Data de vencimento do título do Contas a Receber ou previsão');
            $table->date('pagamento')->nullable()->comment('Data de pagamento do título do Contas a Receber ou previsão');
            $table->string('observacao')->nullable()->comment('Observações sobre o título');

            $table->bigInteger('usuario_id')->nullable()->comment('ID do usuário que realizou a alteração');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status')->nullable()->default('0')->comment('Status do Contas a Receber, 0 inativo e 1 ativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('contasarecebers');
    }

}

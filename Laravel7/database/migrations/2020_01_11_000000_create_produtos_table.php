<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
         
            $table->string('nome')->comment('Descrição do produto');
            $table->bigInteger('codbarras')->nullable()->comment('Codigo de barras do produto');
            $table->decimal('valor', 10, 2)->nullable()->comment('Valor do Produto');
            $table->decimal('valordecompra', 10, 2)->nullable()->comment('Valor de Compra do Produto');
            $table->integer('quantidade')->default('0')->comment('Quantidade de produtos');
            $table->string('localdeestoque')->nullable()->comment('Local de estoque');
            $table->string('observacao')->nullable()->comment('Observações sobre o título');
            
            $table->bigInteger('usuario_id')->nullable()->comment('ID do usuário que realizou a alteração');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status')->nullable()->default('0')->comment('Status do Contas a Pagar, 0 inativo e 1 ativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('produtos');
    }

}

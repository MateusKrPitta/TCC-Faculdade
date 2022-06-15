<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCredenciadosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('credenciados', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');

            $table->string('nome')->comment('Nome da Credenciado');
            $table->string('cpfcnpj')->nullable()->comment('Numero do CPF');
            $table->string('rgie')->nullable()->comment('Numero do RG');
            $table->date('nascimento')->nullable()->comment('Data de Nascimento do Conveniado');
            $table->string('sexo', 10)->nullable()->comment('Sexo do Cliente');
            $table->string('tel1')->nullable()->comment('Numero de Telefone');
            $table->string('tel2')->nullable()->comment('Numero de Telefone');
            $table->string('whatsapp')->nullable()->comment('Numero de Telefone Whatsapp');
            $table->string('email')->nullable()->comment('Endereco eletronico');
            $table->string('site')->nullable()->comment('Endereco do site');
            
            $table->string('logradouro')->nullable()->comment('Nome do Logradouro');
            $table->Integer('numero')->nullable()->comment('Número do Endereço');
            $table->string('bairro')->nullable()->comment('Nome do Bairro');
            $table->string('complemento')->nullable()->comment('Complemento do Endereço');
            $table->string('cidade')->nullable()->comment('Nome da Cidade');
            $table->string('estado', 2)->nullable()->comment('Nome do Estado da UF');
            $table->string('cep')->nullable()->comment('Numero do CEP');
            $table->text('observacao')->nullable()->comment('');
            
            $table->unsignedBigInteger('usuario_id')->nullable()->comment('ID do usuário que realizou a alteração');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status')->nullable()->default('1')->comment('Status do Credenciado, 0 inativo e 1 ativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('credenciados');
    }

}

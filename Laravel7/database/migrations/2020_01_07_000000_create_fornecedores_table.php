<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFornecedoresTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');

            $table->string('nome')->comment('Nome do Cliente / Fornecedor');
            $table->string('razaosocial')->nullable()->comment('Razão Social do Cliente-Fornecedor quando for Pessoa Juridica');
            $table->string('cpfcnpj')->comment('Numero da inscrição CNPJ ou CPF');
            $table->string('rgie')->nullable()->comment('Numero da inscrição estadual ou RG');
            $table->date('nascimento')->nullable()->comment('Data de abertura da Razão Social');
            $table->text('observacoes')->nullable()->comment('');
            
            $table->unsignedBigInteger('usuario_id')->nullable()->comment('ID do usuário que realizou a alteração');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status')->nullable()->default('1')->comment('Status do Fornecedor, 0 inativo e 1 ativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('fornecedores');
    }

}

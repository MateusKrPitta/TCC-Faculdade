<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConveniadosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('conveniados', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');

            $table->unsignedInteger('titular_id')->nullable()->comment('ID do titular do convenio');
            $table->string('nome')->comment('Nome do Conveniado');
            $table->string('cpfcnpj')->nullable()->comment('Numero do CPF');
            $table->string('rgie')->nullable()->comment('Numero do RG');
            $table->date('nascimento')->nullable()->comment('Data de Nascimento do Conveniado');
            $table->string('tel1')->nullable()->comment('Numero de Telefone');
            $table->string('tel2')->nullable()->comment('Numero de Telefone');
            $table->string('e-mail')->nullable()->comment('Endereco eletronico');
            $table->string('sexo', 10)->nullable()->comment('Sexo do Cliente');
            
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
            $table->tinyInteger('status')->nullable()->default('1')->comment('Status do Conveniado, 0 inativo, 1 ativo, 2 aguardando contrato, 3 aguardando assinatura, 4 aguardando confirmação de pagamento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('conveniados');
    }

}

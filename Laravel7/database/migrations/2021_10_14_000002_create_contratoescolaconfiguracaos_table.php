<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratoescolaconfiguracaosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('contratoescolaconfiguracaos', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');

            $table->string('titulocontrato1')->nullable()->comment('Título no contrato primeira linha');
            $table->string('titulocontrato2')->nullable()->comment('Título no contrato segunda linha');
            $table->string('endereco1')->nullable()->comment('Endereço primeira linha');
            $table->string('endereco2')->nullable()->comment('Endereço segunda linha');
            $table->string('razaosocial')->nullable()->comment('Razão Social no contrato');
            $table->string('enderecorazaosocial')->nullable()->comment('Endereço da razão social');
            $table->string('cnpj')->nullable()->comment('CNPJ no contrato');
            $table->string('inscricaomunicipal')->nullable()->comment('inscricao Municipal no contrato');
            $table->string('valorintegral')->nullable()->comment('Valor anual integral');
            $table->string('valorparcial')->nullable()->comment('Valor Anual Parcial');
            $table->string('valorhoraextra')->nullable()->comment('Valor de horas extras');
            $table->string('valorrefeicaoextra')->nullable()->comment('Valor da refeição extra');
            $table->string('valor19horas')->nullable()->comment('Valor após as 19 horas');
            $table->string('horariointegral')->nullable()->comment('horário integral');
            $table->string('horarioparcial')->nullable()->comment('horário parcial');
            $table->string('anexotexto')->nullable()->comment('Texto no Anexo 1');
            $table->string('cidadeforo')->nullable()->comment('Cidade eleita para foro');
            $table->string('cidadecontrato')->nullable()->comment('Cidade local da assinatura do contrato');
            
            $table->unsignedBigInteger('usuario_id')->nullable()->comment('ID do usuário que realizou a alteração');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status')->nullable()->default('1')->comment('Status do Contratoescola, 0 inativo e 1 ativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('contratoescolaconfiguracaos');
    }

}

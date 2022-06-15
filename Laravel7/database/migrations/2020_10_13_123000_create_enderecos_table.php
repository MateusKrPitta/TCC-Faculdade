<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');

            $table->unsignedBigInteger('cliente_id')->nullable()->comment('ID do cliente');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->string('logradouro')->comment('Nome do Logradouro');
            $table->Integer('numero')->comment('Número do Endereço');
            $table->string('bairro')->comment('Nome do Bairro');
            $table->string('complemento')->comment('Complemento do Endereço');
            $table->string('cidade')->comment('Nome da Cidade');
            $table->string('estado', 2)->comment('Nome do Estado da UF');
            $table->string('cep')->comment('Numero do CEP');

            $table->unsignedBigInteger('usuario_id')->nullable()->comment('ID do usuário que realizou a alteração');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('enderecos');
    }

}

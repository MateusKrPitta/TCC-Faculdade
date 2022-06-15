<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVeiculosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('veiculos', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');

            $table->string('nome')->comment('Nome do Veiculo');
            $table->string('marcamodelo')->nullable()->comment('Marca e modelo do veículo');
            $table->string('placa')->nullable()->comment('Placa do veículo');
            $table->unsignedInteger('acentos')->nullable()->comment('Número de acentos disponiveis');
            $table->string('desenho')->nullable()->comment('Desenho do onibus');
            $table->string('imagem')->nullable()->comment('Imagem do onibus');
            $table->text('observacoes')->nullable()->comment('');
            
            $table->unsignedBigInteger('usuario_id')->nullable()->comment('ID do usuário que realizou a alteração');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status')->nullable()->default('1')->comment('Status do Veiculo, 0 inativo e 1 ativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('veiculos');
    }

}

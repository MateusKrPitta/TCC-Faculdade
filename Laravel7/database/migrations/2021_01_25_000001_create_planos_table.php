<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('planos', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');

            $table->string('nome')->comment('Nome do Plano');
            $table->decimal('valor', 10, 2)->nullable()->default('0')->comment('Valor do Plano');
            $table->unsignedBigInteger('tempodeduracao')->nullable()->comment('Tempo de duração do plano');
            $table->tinyInteger('renovacaoautomatica')->default('0')->comment('Será renovado automaticamente depois da validade? 0-Não, 1-Sim');
            $table->unsignedBigInteger('quantidadedependentes')->default('0')->comment('Quantidade de dependentes');

            $table->unsignedBigInteger('usuario_id')->nullable()->comment('ID do usuário que realizou a alteração');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status')->nullable()->default('1')->comment('Siatuacao do plano: 0-Inativo, 1-Ativo, 2-Bloqueado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('planos');
    }

}

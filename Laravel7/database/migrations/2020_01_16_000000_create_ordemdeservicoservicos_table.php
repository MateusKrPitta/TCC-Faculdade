<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdemdeservicoservicosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('ordemdeservicoservicos', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
            
            $table->unsignedInteger('ordemdeservico_id')->comment('ID de ordem de servico');
            $table->foreign('ordemdeservico_id')->references('id')->on('ordemdeservicos')->onDelete('cascade');
            $table->unsignedInteger('servico_id')->comment('ID de servico');
            $table->foreign('servico_id')->references('id')->on('servicos')->onDelete('cascade');
            
            $table->bigInteger('usuario_id')->nullable()->comment('ID do usuário que realizou a alteração');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status')->nullable()->default('0')->comment('Status do Servico, 0 inativo e 1 ativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('ordemdeservicoservicos');
    }

}

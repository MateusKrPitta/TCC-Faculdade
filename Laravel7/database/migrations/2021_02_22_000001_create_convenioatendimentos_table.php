<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConvenioatendimentosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('convenioatendimentos', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');

            $table->unsignedInteger('conveniado_id')->comment('ID do conveniado');
            $table->foreign('conveniado_id')->references('id')->on('conveniados')->onDelete('cascade');

            $table->unsignedInteger('credenciado_id')->comment('ID do credenciado');
            $table->foreign('credenciado_id')->references('id')->on('credenciados')->onDelete('cascade');

            $table->date('data')->comment('Data do registro');
            $table->tinyInteger('tipodeatendimento')->nullable()->comment('Tipo de Atendimento: consulta, exame, compras, outros');
            $table->decimal('valor', 10, 2)->nullable()->default('0')->comment('Valor do Contrato');
            $table->string('nomedoresponsavel')->nullable()->comment('Nome do responsavel pelo atendimento');
            $table->string('observacao')->nullable()->comment('Observações gerais');

            $table->unsignedBigInteger('usuario_id')->nullable()->comment('ID do usuário que realizou a alteração');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status')->nullable()->default('1')->comment('Status do Contratoviagem, 0 inativo e 1 ativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('convenioatendimentos');
    }

}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatriculasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('matriculas', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');

            $table->unsignedBigInteger('aluno_id')->nullable()->comment('ID do aluno');
            $table->foreign('aluno_id')->references('id')->on('alunos')->onDelete('cascade');

            $table->unsignedBigInteger('turma_id')->nullable()->comment('ID da turma');
            $table->foreign('turma_id')->references('id')->on('turmas')->onDelete('cascade');

            $table->double('valor_matricula')->nullable()->comment('Valor pago na matricula');
            $table->double('valor_mensalidade')->nullable()->comment('Valor da mensalidade');
            $table->text('observacoes')->nullable()->comment('Observações sobre a matricula');

            $table->unsignedBigInteger('usuario_id')->nullable()->comment('ID do usuário que realizou a alteração');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status')->nullable()->default('1')->comment('Status do Cliente, 0 inativo e 1 ativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('matriculas');
    }

}

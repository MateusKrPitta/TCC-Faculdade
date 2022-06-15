<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->string('nome')->comment('Nome da Empresa Cadastrada');
            $table->string('razaosocial')->nullable()->comment('Razão Social da Empresa');
            $table->string('cpfcnpj')->comment('Numero da inscrição CNPJ');
            $table->string('rgie')->nullable()->comment('Numero da Inscrição Estadual');
            $table->text('observacoes')->nullable()->comment('');
            
            $table->unsignedBigInteger('usuario_id')->nullable()->comment('ID do usuário que realizou a alteração');
            //$table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status')->nullable()->default('1')->comment('Status do Viagem, 0 inativo e 1 ativo');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('empresas');
    }

}

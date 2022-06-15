<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGestacaosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('gestacaos', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');

            $table->unsignedBigInteger('animal_id')->nullable()->comment('ID no cadastro de animal');

            $table->foreign('animal_id')
                    ->references('id')->on('animals')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('inseminacao_id')->unique()->nullable()->comment('ID no cadastro de inseminacao');

            $table->foreign('inseminacao_id')
                    ->references('id')->on('inseminacaos')
                    ->onDelete('cascade');

            $table->date('dataconfirmacao')->nullable()->comment('Data da confirmacao de inseminacao do Animal ou previsão');
            $table->string('examinador')->comment('Nome do Inseminador');
            $table->char('status_gestacao', '1')->default('0')->comment('Status: 1-Gestando ou 2-Não Fecundou');

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
        Schema::dropIfExists('gestacaos');
    }

}

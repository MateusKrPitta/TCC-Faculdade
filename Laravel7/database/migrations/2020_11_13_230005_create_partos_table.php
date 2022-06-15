<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('partos', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');

            $table->unsignedBigInteger('animal_id')->nullable()->comment('ID no cadastro de animal');

            $table->foreign('animal_id')
                    ->references('id')->on('animals')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('filhote_id')->nullable()->comment('ID no cadastro de animal');

            $table->foreign('filhote_id')
                    ->references('id')->on('animals')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('inseminacao_id')->nullable()->comment('ID no cadastro de inseminacao');

            $table->foreign('inseminacao_id')
                    ->references('id')->on('inseminacaos')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('gestacao_id')->nullable()->comment('ID no cadastro de gestacao');

            $table->foreign('gestacao_id')
                    ->references('id')->on('gestacaos')
                    ->onDelete('cascade');

            $table->date('dataparto')->nullable()->comment('Data do parto do Animal ou previsão');
            $table->string('acompanhante')->nullable()->comment('Nome do Inseminador');
            $table->char('status_parto', '1')->default('V')->comment('Status: V-Vivo ou M-Morto');

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
        Schema::dropIfExists('partos');
    }

}

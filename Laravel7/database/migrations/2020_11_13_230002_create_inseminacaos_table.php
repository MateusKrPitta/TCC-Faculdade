<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInseminacaosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('inseminacaos', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');

            $table->unsignedBigInteger('animal_id')->nullable()->comment('ID no cadastro de animal');

            $table->foreign('animal_id')
                    ->references('id')->on('animals')
                    ->onDelete('cascade');

            $table->date('datainseminacao')->nullable()->comment('Data de inseminacao do Animal ou previsão');
            $table->char('turno', '1')->default('M')->comment('Turno da inseminação, M-Manhã, T-Tarde, N-Noite');
            $table->string('touro')->comment('Nome do Touro');
            $table->string('inseminador')->comment('Nome do Inseminador');

            $table->char('status_inseminacao', '1')->default('0')->comment('Status: 0-Aguardando ou 1-Gestando ou 2-Não fecundou');

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
        Schema::dropIfExists('inseminacaos');
    }

}

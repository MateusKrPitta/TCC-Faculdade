<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacinacaosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('vacinacaos', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');

            $table->unsignedBigInteger('animal_id')->nullable()->comment('ID no cadastro de animal');
            $table->foreign('animal_id')
                    ->references('id')->on('animals')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('vacina_id')->nullable()->comment('ID no cadastro de vacina');
            $table->foreign('vacina_id')
                    ->references('id')->on('vacinas')
                    ->onDelete('cascade');

            $table->date('datavacina')->comment('Data do evento');

            $table->unsignedBigInteger('usuario_id')->nullable()->comment('ID do usuário que realizou a alteração');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status')->nullable()->default('1')->comment('Status da vacinacao, 0 inativo e 1 ativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('vacinacaos');
    }

}

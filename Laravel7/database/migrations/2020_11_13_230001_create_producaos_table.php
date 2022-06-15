<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProducaosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('producaos', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');

            $table->unsignedBigInteger('animal_id')->nullable()->comment('ID no cadastro de animal');
            $table->foreign('animal_id')->references('id')->on('animals')->onDelete('cascade')->comment('Chave Estrangeira do ID do Animal');
            $table->date('data_producao')->comment('Data do evento');
            $table->time('hora_producao')->comment('Hora do evento');
            $table->float('quantidade')->nullable()->default('0')->comment('Quantidade de leite produzida');

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
        Schema::dropIfExists('producaos');
    }

}

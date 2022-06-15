<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfiguracaosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('configuracaos', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');

            $table->unsignedInteger('diasdegestacao')->comment('Dias de gestação');
            $table->unsignedInteger('mesesparaprimeirainseminacao')->comment('Quantidade de meses para a primeira inseminação');
            $table->unsignedInteger('pesominimoparainseminacao')->comment('Peso mínimo para a primeira inseminação');
            $table->unsignedInteger('diasparainseminacao')->comment('Quantidade de dias para inseminação após o parto');
            $table->unsignedInteger('diasparaconfirmacaodeinseminacao')->comment('Quantidade de dias para confirmação da inseminação');
            $table->unsignedInteger('diasparasecaravacaantesdoparto')->comment('Quantidade de dias para secar a vaca antes do parto');

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
        Schema::dropIfExists('configuracaos');
    }

}

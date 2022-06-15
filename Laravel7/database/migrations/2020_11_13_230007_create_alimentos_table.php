<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlimentosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('alimentos', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');

            $table->string('nome')->comment('Nome utilizado para identificar o Alimento');
            $table->text('composicao')->comment('Ingredientes utilizados para compor o Alimento');
            $table->float('peso')->nullable()->default('0')->comment('Peso Total da Alimentação em Quilogramas');
            $table->decimal('valor', 10, 2)->nullable()->default('0')->comment('Valor pago no total da Alimentação');
            $table->date('inicio')->nullable()->comment('Início do Consumo do Alimento');
            $table->date('fim')->nullable()->comment('Fim do consumo do Alimento');

            $table->unsignedBigInteger('usuario_id')->nullable()->comment('ID do usuário que realizou a alteração');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status')->nullable()->default('0')->comment('Status, 0 inativo e 1 ativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('alimentos');
    }

}

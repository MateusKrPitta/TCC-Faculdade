<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlimentacaosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('alimentacaos', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
            
            $table->unsignedBigInteger('animal_id')->nullable()->comment('ID no cadastro de animal');
            $table->foreign('animal_id')
                    ->references('id')->on('animals')
                    ->onDelete('cascade');
            
            $table->unsignedBigInteger('alimento_id')->nullable()->comment('ID no cadastro de alimento');
            $table->foreign('alimento_id')
                    ->references('id')->on('alimentos')
                    ->onDelete('cascade');

            $table->float('peso')->nullable()->default('0')->comment('Peso Total da Alimentação em Quilogramas');
            $table->date('dataalimentacao')->comment('Data do evento');
           
            $table->unsignedBigInteger('usuario_id')->nullable()->comment('ID do usuário que realizou a alteração');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status')->nullable()->default('1')->comment('Status da alimentacao, 0 inativo e 1 ativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('alimentacaos');
    }

}

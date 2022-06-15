<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('animals', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
            
            $table->string('nome')->comment('Nome do Animal');
            $table->unsignedBigInteger('numero')->nullable()->comment('Numero de Identificação do animal, geralmente o brinco ou o chip');
            $table->date('nascimento')->nullable()->comment('Data de Nascimento do Animal ou previsão');
            $table->string('pai')->nullable()->comment('Pai do Animal');
            $table->string('mae')->nullable()->comment('Mãe do Animal');
            $table->float('peso')->nullable()->default('0')->comment('Peso do Animal em Quilogramas');
            $table->char('sexo', '1')->default('F')->comment('Sexo do Animal, M Macho e F Femea');
            $table->text('observacoes')->nullable()->comment('');
            
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
        Schema::dropIfExists('animals');
    }

}

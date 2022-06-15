<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViagemsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('viagems', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');

            $table->string('nome')->nullable()->comment('Nome da Viagem');
            $table->string('origem')->comment('Nome da origem');
            $table->string('destino')->comment('Nome da destino');
            $table->date('data')->nullable()->comment('Data do evento');
            $table->time('hora')->nullable()->comment('Hora do evento');
            $table->decimal('valor', 10, 2)->nullable()->default('0')->comment('Valor da viagem');
            $table->unsignedInteger('veiculo_id')->nullable()->comment('ID do veículo');
            $table->foreign('veiculo_id')->references('id')->on('veiculos')->onDelete('cascade');
            $table->text('observacao')->nullable()->comment('');
            
            $table->unsignedBigInteger('usuario_id')->nullable()->comment('ID do usuário que realizou a alteração');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('viagems');
    }

}

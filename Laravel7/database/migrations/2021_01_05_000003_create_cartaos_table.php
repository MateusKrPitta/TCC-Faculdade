<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartaosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('cartaos', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
            $table->unsignedInteger('conveniado_id')->comment('ID do conveniado portador do cartao');
            $table->foreign('conveniado_id')->references('id')->on('conveniados')->onDelete('cascade');
            $table->string('nomenocartao')->comment('Nome do Cartao');
            $table->string('numeronocartao')->comment('Numero do Cartao');
            $table->date('datadeemissao')->nullable()->comment('Data da emissao');
            $table->date('datadevalidade')->nullable()->comment('Data da validade');
            $table->tinyInteger('status')->nullable()->default('1')->comment('Siatuacao do cartao: 0-Inativo, 1-Ativo, 2-Bloqueado');
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
        Schema::dropIfExists('cartaos');
    }

}

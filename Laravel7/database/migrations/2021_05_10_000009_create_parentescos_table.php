<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentescosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('parentescos', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
            
            $table->String('nome')->comment('Titulo do Parentesco');
            $table->integer('senior')->comment('Pode ser Senior: 0-Não 1-Sim');
            
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
        Schema::dropIfExists('parentescos');
    }

}

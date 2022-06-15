<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSistemalogsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('sistemalogs', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
            $table->unsignedBigInteger('usuario_id')->nullable()->comment('ID do usuário que realizou a alteração');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->string('modulo')->nullable()->comment('Modulo utilizado');
            $table->string('acao')->nullable()->comment('Ação realizada');
            $table->string('antes')->nullable()->comment('Dados originais');
            $table->string('depois')->nullable()->comment('Dados alterados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('sistemalogs');
    }

}

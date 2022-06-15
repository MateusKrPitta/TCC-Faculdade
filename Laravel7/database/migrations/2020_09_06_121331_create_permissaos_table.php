<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissaosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('permissaos', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->string('nome', 100);
            $table->string('descricao', 150);
            $table->unsignedBigInteger('grupo')->nullable()->comment('Grupo de Permissão');

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
        Schema::dropIfExists('permissaos');
    }

}

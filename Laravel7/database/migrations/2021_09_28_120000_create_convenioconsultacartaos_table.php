<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConvenioconsultacartaosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('convenioconsultacartaos', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');

            $table->unsignedInteger('conveniado_id')->nullable()->comment('ID do conveniado');
            $table->foreign('conveniado_id')->references('id')->on('conveniados')->onDelete('cascade');

            $table->unsignedInteger('credenciado_id')->nullable()->comment('ID do credenciado');
            $table->foreign('credenciado_id')->references('id')->on('credenciados')->onDelete('cascade');
            
            $table->String('numero')->nullable()->comment('Número consultado');

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
        Schema::dropIfExists('convenioconsultacartaos');
    }

}

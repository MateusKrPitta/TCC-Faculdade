<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacinasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('vacinas', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');

            $table->string('nomevacina')->comment('Nome da vacina');
            $table->char('sexoaplicacao', '1')->default('A')->comment('Sexo do Animal, M Macho, F Femea ou A Ambos');
            $table->date('datainicio')->nullable()->comment('Data de início da aplicação da vacina');
            $table->date('datafim')->nullable()->comment('Data de fim da aplicação da vacina');
            $table->char('tipovacina', '1')->default('U')->comment('Tipo de Vacina, U Unica, P Periodico ou A Aleatorio');
            $table->unsignedBigInteger('intervalovacina')->nullable()->comment('Intervalo de meses entre as vacinas');
           
            $table->unsignedBigInteger('usuario_id')->nullable()->comment('ID do usuário que realizou a alteração');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status')->nullable()->default('1')->comment('Status da Vacina, 0 inativo e 1 ativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('vacinas');
    }

}

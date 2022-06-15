<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePassagemsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('passagems', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
            
            $table->unsignedInteger('viagem_id')->comment('id da viagem');
            $table->foreign('viagem_id')->references('id')->on('viagems')->onDelete('cascade');
            
            $table->unsignedInteger('cliente_id')->comment('id do cliente');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            
            $table->string('localembarque')->comment('Nome da cidade de embarque');
            $table->unsignedInteger('acento')->nullable()->comment('Acento do veiculo');
            $table->decimal('valor', 10, 2)->nullable()->default('0')->comment('Valor da viagem');
            $table->unsignedInteger('pagamento')->nullable()->comment('Forma de pagamento: 1-Pago, 2-Contas a Receber');
            
            $table->unsignedBigInteger('usuario_id')->nullable()->comment('ID do usuário que realizou a alteração');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status')->nullable()->default('1')->comment('Status do Passagem, 0 inativo e 1 ativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('passagems');
    }

}

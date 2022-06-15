<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContatoTableFornecedores extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('fornecedores', function (Blueprint $table) {
            $table->string('tel1')->nullable()->comment('Numero de Telefone');
            $table->string('tel2')->nullable()->comment('Numero de Telefone');
            $table->string('logradouro')->nullable()->comment('Nome do Logradouro');
            $table->Integer('numero')->nullable()->comment('Número do Endereço');
            $table->string('bairro')->nullable()->comment('Nome do Bairro');
            $table->string('complemento')->nullable()->comment('Complemento do Endereço');
            $table->string('cidade')->nullable()->comment('Nome da Cidade');
            $table->string('estado', 2)->nullable()->comment('Nome do Estado da UF');
            $table->string('cep')->nullable()->comment('Numero do CEP');
            
            $table->string('email')->nullable()->comment('Endereço de e-mail');
            $table->string('contatonome')->nullable()->comment('Nome do contato');
            $table->string('contatotelefone')->nullable()->comment('Telefone do contato');
            $table->string('contatoemail')->nullable()->comment('E-mail do contato');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('fornecedores', function (Blueprint $table) {
            if (Schema::hasColumn('fornecedores', 'tel1')) {
                $table->dropColumn('tel1');
            }
            if (Schema::hasColumn('fornecedores', 'tel2')) {
                $table->dropColumn('tel2');
            }
            if (Schema::hasColumn('fornecedores', 'logradouro')) {
                $table->dropColumn('logradouro');
            }
            if (Schema::hasColumn('fornecedores', 'numero')) {
                $table->dropColumn('numero');
            }
            if (Schema::hasColumn('fornecedores', 'bairro')) {
                $table->dropColumn('bairro');
            }
            if (Schema::hasColumn('fornecedores', 'complemento')) {
                $table->dropColumn('complemento');
            }
            if (Schema::hasColumn('fornecedores', 'cidade')) {
                $table->dropColumn('cidade');
            }
            if (Schema::hasColumn('fornecedores', 'estado')) {
                $table->dropColumn('estado');
            }
            if (Schema::hasColumn('fornecedores', 'cep')) {
                $table->dropColumn('cep');
            }
            if (Schema::hasColumn('fornecedores', 'email')) {
                $table->dropColumn('email');
            }
            if (Schema::hasColumn('fornecedores', 'contatonome')) {
                $table->dropColumn('contatonome');
            }
            if (Schema::hasColumn('fornecedores', 'contatotelefone')) {
                $table->dropColumn('contatotelefone');
            }
            if (Schema::hasColumn('fornecedores', 'contatoemail')) {
                $table->dropColumn('contatoemail');
            }
        });
    }

}

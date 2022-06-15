<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContatoTableClientes extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('clientes', function (Blueprint $table) {
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
        Schema::table('clientes', function (Blueprint $table) {
            if (Schema::hasColumn('clientes', 'email')) {
                $table->dropColumn('email');
            }
            if (Schema::hasColumn('clientes', 'contatonome')) {
                $table->dropColumn('contatonome');
            }
            if (Schema::hasColumn('clientes', 'contatotelefone')) {
                $table->dropColumn('contatotelefone');
            }
            if (Schema::hasColumn('clientes', 'contatoemail')) {
                $table->dropColumn('contatoemail');
            }
        });
    }

}

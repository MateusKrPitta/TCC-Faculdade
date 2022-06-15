<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContasareceberidTableContratoconvenios extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('contratoconvenios', function (Blueprint $table) {
            //
            $table->unsignedInteger('formadepagamento_id')->nullable()->comment('ID em Contas a Receber'); // Ordenado após a coluna "status"
            $table->foreign('formadepagamento_id')->references('id')->on('formadepagamentos')->onDelete('cascade');
            $table->unsignedInteger('contasareceber_id')->nullable()->comment('ID em Contas a Receber'); // Ordenado após a coluna "status"
            $table->foreign('contasareceber_id')->references('id')->on('contasarecebers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('contratoconvenios', function (Blueprint $table) {
            if (Schema::hasColumn('contratoconvenios', 'contasareceber_id')) {
                $table->dropColumn('contasareceber_id');
            }
            if (Schema::hasColumn('contratoconvenios', 'formadepagamento_id')) {
                $table->dropColumn('formadepagamento_id');
            }
        });
    }

}

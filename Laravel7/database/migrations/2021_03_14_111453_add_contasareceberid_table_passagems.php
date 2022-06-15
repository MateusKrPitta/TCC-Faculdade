<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContasareceberidTablePassagems extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('passagems', function (Blueprint $table) {
            //
            $table->unsignedInteger('contasareceber_id')->nullable()->after('status')->comment('ID em Contas a Receber'); // Ordenado após a coluna "status"
            $table->foreign('contasareceber_id')->references('id')->on('contasarecebers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('passagems', function (Blueprint $table) {
            if (Schema::hasColumn('passagems', 'contasareceber_id')) {
                $table->dropColumn('contasareceber_id');
            }
        });
    }

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFormadepagamentoidTableContasarecebers extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('contasarecebers', function (Blueprint $table) {
            //
            $table->unsignedInteger('formadepagamento_id')->nullable()->comment('ID da forma de pagamento');
            $table->foreign('formadepagamento_id')->references('id')->on('formadepagamentos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('contasarecebers', function (Blueprint $table) {
            if (Schema::hasColumn('contasarecebers', 'formadepagamento_id')) {
                $table->dropColumn('formadepagamento_id');
            }
        });
    }

}

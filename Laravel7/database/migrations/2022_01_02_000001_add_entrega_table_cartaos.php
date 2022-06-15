<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEntregaTableCartaos extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('cartaos', function (Blueprint $table) {
            $table->date('dataproducao')->nullable()->comment('Data do envio para produção');
            $table->date('dataentrega')->nullable()->comment('Data da entrega');     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('cartaos', function (Blueprint $table) {
            if (Schema::hasColumn('cartaos', 'dataentrega')) {
                $table->dropColumn('dataentrega');
            }
            if (Schema::hasColumn('cartaos', 'dataproducao')) {
                $table->dropColumn('dataproducao');
            }
        });
    }

}

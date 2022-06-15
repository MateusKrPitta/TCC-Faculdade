<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCartaosusTableAlunos extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('alunos', function (Blueprint $table) {
            $table->string('cartaosus')->nullable()->comment('Número do Cartão SUS');
            
            $table->char('alergiaalimento', '1')->nullable()->default('')->comment('');
            $table->string('nomealergiaalimento')->nullable()->default('')->comment('');
            
            $table->char('autorizabuscaraluno', '1')->nullable()->default('')->comment('');
            $table->string('autorizabuscaralunonome')->nullable()->default('')->comment('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('alunos', function (Blueprint $table) {
            if (Schema::hasColumn('alunos', 'cartaosus')) {
                $table->dropColumn('cartaosus');
            }
            if (Schema::hasColumn('alunos', 'alergiaalimento')) {
                $table->dropColumn('alergiaalimento');
            }
            if (Schema::hasColumn('alunos', 'nomealergiaalimento')) {
                $table->dropColumn('nomealergiaalimento');
            }
            if (Schema::hasColumn('alunos', 'autorizabuscaraluno')) {
                $table->dropColumn('autorizabuscaraluno');
            }
            if (Schema::hasColumn('alunos', 'autorizabuscaralunonome')) {
                $table->dropColumn('autorizabuscaralunonome');
            }
        });
    }

}

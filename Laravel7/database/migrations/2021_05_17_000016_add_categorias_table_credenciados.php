<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoriasTableCredenciados extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('credenciados', function (Blueprint $table) {
            $table->string('imagem')->nullable()->comment('Nome da imagem');
            $table->string('instagram')->nullable()->comment('Endereco do instagram');
            $table->string('facebook')->nullable()->comment('Endereco do facebook');
            $table->unsignedInteger('credenciadocategoria_id')->nullable()->comment('ID da forma de pagamento');
            $table->foreign('credenciadocategoria_id')->references('id')->on('credenciadocategorias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('credenciados', function (Blueprint $table) {
            if (Schema::hasColumn('credenciados', 'imagem')) {
                $table->dropColumn('imagem');
            }
            if (Schema::hasColumn('credenciados', 'instagram')) {
                $table->dropColumn('instagram');
            }
            if (Schema::hasColumn('credenciados', 'facebook')) {
                $table->dropColumn('facebook');
            }
            if (Schema::hasColumn('credenciados', 'credenciadocategoria_id')) {
                $table->dropColumn('credenciadocategoria_id');
            }
        });
    }

}

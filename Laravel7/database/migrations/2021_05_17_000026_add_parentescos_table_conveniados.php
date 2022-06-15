<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentescosTableConveniados extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('conveniados', function (Blueprint $table) {
            $table->unsignedInteger('parentesco_id')->nullable()->comment('ID do parentesco');
            $table->foreign('parentesco_id')->references('id')->on('parentescos')->onDelete('cascade');
            $table->unsignedInteger('estadocivil_id')->nullable()->comment('ID do estado civil');
            $table->foreign('estadocivil_id')->references('id')->on('estadocivils')->onDelete('cascade');
            $table->string('email')->nullable()->comment('Endereço de e-mail');
            $table->string('imagem')->nullable()->comment('Nome da imagem');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('conveniados', function (Blueprint $table) {
            if (Schema::hasColumn('conveniados', 'parentesco_id')) {
                $table->dropColumn('parentesco_id');
            }
            if (Schema::hasColumn('conveniados', 'estadocivil_id')) {
                $table->dropColumn('estadocivil_id');
            }
            if (Schema::hasColumn('conveniados', 'email')) {
                $table->dropColumn('email');
            }
            if (Schema::hasColumn('credenciados', 'imagem')) {
                $table->dropColumn('imagem');
            }
        });
    }

}

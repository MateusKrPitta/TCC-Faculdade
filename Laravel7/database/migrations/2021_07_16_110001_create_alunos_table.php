<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('alunos', function (Blueprint $table) {
            $table->increments('id');
            $table->index('id');
            $table->unsignedInteger('empresa_id')->comment('ID da empresa multi-empresa');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');

            $table->string('nome')->comment('Nome do Aluno');
            $table->char('sexo', '1')->default('F')->comment('Sexo do Aluno');
            $table->date('nascimento')->nullable()->comment('Data de Nascimento do Aluno ou previsão');

            $table->string('cpf')->nullable()->default('')->comment('');

            $table->string('nomepai')->nullable()->default('')->comment('');
            $table->string('numerotelefonepai')->nullable()->default('')->comment('');
            $table->date('nascimentopai')->nullable()->comment('');
            $table->string('cpfpai')->nullable()->default('')->comment('');
            $table->string('enderecopai')->nullable()->default('')->comment('');
            $table->string('bairropai')->nullable()->default('')->comment('');
            $table->string('cidadepai')->nullable()->default('')->comment('');
            $table->char('estadopai', '2')->nullable()->default('')->comment('');
            $table->string('emailpai')->nullable()->default('')->comment('');

            $table->string('trabalhopai')->nullable()->default('')->comment('');
            $table->string('telefonetrabalhopai')->nullable()->default('')->comment('');
            $table->string('cargopai')->nullable()->default('')->comment('');
            $table->string('horariopai')->nullable()->default('')->comment('');

            $table->string('nomemae')->nullable()->default('')->comment('');
            $table->string('numerotelefonemae')->nullable()->default('')->comment('');
            $table->date('nascimentomae')->nullable()->comment('');
            $table->string('cpfmae')->nullable()->default('')->comment('');
            $table->string('enderecomae')->nullable()->default('')->comment('');
            $table->string('bairromae')->nullable()->default('')->comment('');
            $table->string('cidademae')->nullable()->default('')->comment('');
            $table->char('estadomae', '2')->nullable()->default('')->comment('');
            $table->string('emailmae')->nullable()->default('')->comment('');

            $table->string('trabalhomae')->nullable()->default('')->comment('');
            $table->string('telefonetrabalhomae')->nullable()->default('')->comment('');
            $table->string('cargomae')->nullable()->default('')->comment('');
            $table->string('horariomae')->nullable()->default('')->comment('');

            $table->char('relacaopais', '1')->nullable()->default('')->comment('');
            $table->char('cuidados', '1')->nullable()->default('')->comment('');

            $table->string('nomeresponsavel')->nullable()->default('')->comment('');
            $table->string('numerotelefoneresponsavel')->nullable()->default('')->comment('');
            $table->date('nascimentoresponsavel')->nullable()->comment('');
            $table->string('cpfresponsavel')->nullable()->default('')->comment('');
            $table->string('enderecoresponsavel')->nullable()->default('')->comment('');
            $table->string('bairroresponsavel')->nullable()->default('')->comment('');
            $table->string('cidaderesponsavel')->nullable()->default('')->comment('');
            $table->char('estadoresponsavel', '2')->nullable()->default('')->comment('');
            $table->string('emailresponsavel')->nullable()->default('')->comment('');

            $table->string('trabalhoresponsavel')->nullable()->default('')->comment('');
            $table->string('telefonetrabalhoresponsavel')->nullable()->default('')->comment('');
            $table->string('cargoresponsavel')->nullable()->default('')->comment('');
            $table->string('horarioresponsavel')->nullable()->default('')->comment('');

            $table->string('nomeresponsavelfinanceiro')->nullable()->default('')->comment('');
            $table->string('numerotelefoneresponsavelfinanceiro')->nullable()->default('')->comment('');
            $table->string('cpfresponsavelfinanceiro')->nullable()->default('')->comment('');
            $table->string('emailresponsavelfinanceiro')->nullable()->default('')->comment('');

            $table->char('papinhasalgada', '1')->nullable()->default('')->comment('');
            $table->char('papinhadefrutas', '1')->nullable()->default('')->comment('');
            $table->char('suco', '1')->nullable()->default('')->comment('');
            $table->string('outraalimentacao')->nullable()->default('')->comment('');
            $table->char('planodesaude', '1')->nullable()->default('')->comment('');
            $table->string('nomeplanodesaude')->nullable()->default('')->comment('');
            $table->char('medicamentos', '1')->nullable()->default('')->comment('');
            $table->string('nomemedicamentos')->nullable()->default('')->comment('');
            $table->char('alergia', '1')->nullable()->default('')->comment('');
            $table->string('nomealergia')->nullable()->default('')->comment('');
            $table->char('problemasaude', '1')->nullable()->default('')->comment('');
            $table->string('nomeproblemasaude')->nullable()->default('')->comment('');
            $table->char('necessidadesfisicas', '1')->nullable()->default('')->comment('');
            $table->string('nomenecessidadesfisicas')->nullable()->default('')->comment('');
            $table->char('oculos', '1')->nullable()->default('')->comment('');
            $table->char('anemia', '1')->nullable()->default('')->comment('');
            $table->char('diabetes', '1')->nullable()->default('')->comment('');
            $table->char('lactose', '1')->nullable()->default('')->comment('');
            $table->char('refluxo', '1')->nullable()->default('')->comment('');
            $table->char('gluten', '1')->nullable()->default('')->comment('');
            $table->char('tiposanguineo', '3')->nullable()->default('')->comment('');
            $table->unsignedInteger('peso')->nullable()->comment('');
            $table->unsignedInteger('altura')->nullable()->comment('');

            $table->text('observacoes')->nullable()->default('')->comment('');

            $table->unsignedBigInteger('usuario_id')->nullable()->comment('ID do usuário que realizou a alteração');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status')->nullable()->default('1')->comment('Status do Cliente, 0 inativo e 1 ativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('alunos');
    }

}

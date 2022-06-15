<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetalhesTableVeiculos extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('veiculos', function (Blueprint $table) {
            $table->string('renavam')->nullable()->comment('Número do RENAVAM');
            $table->string('chassi')->nullable()->comment('Número do chassi');
            $table->string('motor')->nullable()->comment('Número do motor');
            $table->integer('anofabricacao')->nullable()->comment('Ano de fabricação do veículo');
            $table->integer('anomodelo')->nullable()->comment('Ano do modelo do veículo');
            $table->string('cidade')->nullable()->comment('Cidade do veículo');
            $table->string('uf')->nullable()->comment('Sigla do Estado do Veículo');
            $table->string('antt')->nullable()->comment('Código da ANTT');
            $table->string('tara')->nullable()->comment('Valor em quilogramas');
            $table->string('capacidade')->nullable()->comment('Capacidade em Quilogramas');
            $table->string('volume')->nullable()->comment('Volume em metros cúbicos');
            
            $table->unsignedInteger('cor_id')->default('1')->comment('ID da tabela cores de Veículos'); 
            $table->foreign('cor_id')->references('id')->on('veiculoscor')->onDelete('cascade');
            
            $table->unsignedInteger('marca_id')->default('1')->comment('ID da tabela de Marcas de Veículos'); 
            $table->foreign('marca_id')->references('id')->on('veiculosmarca')->onDelete('cascade');
            
            $table->unsignedInteger('especie_id')->default('1')->comment('ID da tabela de Especie de Veículos'); 
            $table->foreign('especie_id')->references('id')->on('veiculosespecie')->onDelete('cascade');
            
            $table->unsignedInteger('categoria_id')->default('1')->comment('ID da tabela de Categorias de Veículos'); 
            $table->foreign('categoria_id')->references('id')->on('veiculoscategoria')->onDelete('cascade');
            
            $table->unsignedInteger('combustivel_id')->default('1')->comment('ID da tabela de Combustíveis de Veículos'); 
            $table->foreign('combustivel_id')->references('id')->on('veiculoscombustivel')->onDelete('cascade');
            
            $table->unsignedInteger('carroceria_id')->default('1')->comment('ID da tabela de Carroceria de Veículos'); 
            $table->foreign('carroceria_id')->references('id')->on('veiculoscarroceria')->onDelete('cascade');
            
            $table->unsignedInteger('rodado_id')->default('1')->comment('ID da tabela de Rodado de Veículos'); 
            $table->foreign('rodado_id')->references('id')->on('veiculosrodado')->onDelete('cascade');
            
            $table->unsignedInteger('linha_id')->default('1')->comment('ID da tabela de Linha de Veículos'); 
            $table->foreign('linha_id')->references('id')->on('veiculoslinha')->onDelete('cascade');
            
            $table->unsignedInteger('propriedade_id')->default('1')->comment('ID da tabela de Propriedade de Veículos'); 
            $table->foreign('propriedade_id')->references('id')->on('veiculospropriedade')->onDelete('cascade');
            
            $table->unsignedInteger('tipo_id')->default('1')->comment('ID da tabela de Tipo de Veículos'); 
            $table->foreign('tipo_id')->references('id')->on('veiculostipo')->onDelete('cascade');
            
            $table->unsignedInteger('eixo_id')->default('1')->comment('ID da tabela de Posição do Eixo de Veículos'); 
            $table->foreign('eixo_id')->references('id')->on('veiculoseixo')->onDelete('cascade');
            
            $table->string('cilindrada')->nullable()->comment('Cilindrada do motor');
            
            $table->decimal('valordobem')->nullable()->comment('Valor do Bem');
            $table->decimal('valorcompensado')->nullable()->comment('Valor compensado em caso de seguro');
            $table->decimal('porcentagem')->nullable()->comment('Valor da porcentagem paga pelo seguro');
            $table->decimal('franquia')->nullable()->comment('Valor da franquia para acionar seguro');
            $table->decimal('quotaparticipacao')->nullable()->comment('Valor para ser pago por quota');
            $table->string('codigofipe')->nullable()->comment('Código FIPE');
            $table->decimal('valorfipe')->nullable()->comment('Valor FIPE');
            
            $table->unsignedInteger('cliente_id')->default('1')->comment('ID do cliente'); 
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('veiculos', function (Blueprint $table) {
            if (Schema::hasColumn('veiculos', 'renavam')) {
                $table->dropColumn('renavam');
            }
            if (Schema::hasColumn('veiculos', 'chassi')) {
                $table->dropColumn('chassi');
            }
            if (Schema::hasColumn('veiculos', 'motor')) {
                $table->dropColumn('motor');
            }
            if (Schema::hasColumn('veiculos', 'anofabricacao')) {
                $table->dropColumn('anofabricacao');
            }
            if (Schema::hasColumn('veiculos', 'anomodelo')) {
                $table->dropColumn('anomodelo');
            }
            if (Schema::hasColumn('veiculos', 'cidade')) {
                $table->dropColumn('cidade');
            }
            if (Schema::hasColumn('veiculos', 'uf')) {
                $table->dropColumn('uf');
            }
            if (Schema::hasColumn('veiculos', 'antt')) {
                $table->dropColumn('antt');
            }
            if (Schema::hasColumn('veiculos', 'tara')) {
                $table->dropColumn('tara');
            }
            if (Schema::hasColumn('veiculos', 'capacidade')) {
                $table->dropColumn('capacidade');
            }
            if (Schema::hasColumn('veiculos', 'volume')) {
                $table->dropColumn('volume');
            }
            if (Schema::hasColumn('veiculos', 'cilindrada')) {
                $table->dropColumn('cilindrada');
            }
            if (Schema::hasColumn('veiculos', 'valordobem')) {
                $table->dropColumn('valordobem');
            }
            if (Schema::hasColumn('veiculos', 'valorcompensado')) {
                $table->dropColumn('valorcompensado');
            }
            if (Schema::hasColumn('veiculos', 'porcentagem')) {
                $table->dropColumn('porcentagem');
            }
            if (Schema::hasColumn('veiculos', 'franquia')) {
                $table->dropColumn('franquia');
            }
            if (Schema::hasColumn('veiculos', 'quotaparticipacao')) {
                $table->dropColumn('quotaparticipacao');
            }
            if (Schema::hasColumn('veiculos', 'codigofipe')) {
                $table->dropColumn('codigofipe');
            }
            if (Schema::hasColumn('veiculos', 'valorfipe')) {
                $table->dropColumn('valorfipe');
            }
            if (Schema::hasColumn('veiculos', 'cliente_id')) {
                $table->dropColumn('cliente_id');
            }
            if (Schema::hasColumn('veiculos', 'cor_id')) {
                $table->dropColumn('cor_id');
            }
            if (Schema::hasColumn('veiculos', 'marca_id')) {
                $table->dropColumn('marca_id');
            }
            if (Schema::hasColumn('veiculos', 'especie_id')) {
                $table->dropColumn('especie_id');
            }
            if (Schema::hasColumn('veiculos', 'categoria_id')) {
                $table->dropColumn('categoria_id');
            }
            if (Schema::hasColumn('veiculos', 'combustivel_id')) {
                $table->dropColumn('combustivel_id');
            }
            if (Schema::hasColumn('veiculos', 'carroceria_id')) {
                $table->dropColumn('carroceria_id');
            }
            if (Schema::hasColumn('veiculos', 'rodado_id')) {
                $table->dropColumn('rodado_id');
            }
            if (Schema::hasColumn('veiculos', 'linha_id')) {
                $table->dropColumn('linha_id');
            }
            if (Schema::hasColumn('veiculos', 'propriedade_id')) {
                $table->dropColumn('propriedade_id');
            }
            if (Schema::hasColumn('veiculos', 'tipo_id')) {
                $table->dropColumn('tipo_id');
            }
            if (Schema::hasColumn('veiculos', 'eixo_id')) {
                $table->dropColumn('eixo_id');
            }
        });
    }

}

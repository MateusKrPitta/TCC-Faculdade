<?php

namespace database\seeds;

use Illuminate\Database\Seeder;
use App\Grupopermissao;

class GrupopermissaosTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        Grupopermissao::create([
            'nome' => 'Atendimento',
            'usuario_id' => '0'
        ]);

        Grupopermissao::create([
            'nome' => 'Rebanho',
            'usuario_id' => '0'
        ]);

        Grupopermissao::create([
            'nome' => 'Financeiro',
            'usuario_id' => '0'
        ]);

        Grupopermissao::create([
            'nome' => 'BI',
            'usuario_id' => '0'
        ]);

        Grupopermissao::create([
            'nome' => 'Importação',
            'usuario_id' => '0'
        ]);
        
        Grupopermissao::create([
            'nome' => 'Configuração',
            'usuario_id' => '0'
        ]);

        
        Grupopermissao::create([
            'nome' => 'Convênio',
            'usuario_id' => '0'
        ]);

        
        Grupopermissao::create([
            'nome' => 'Transportadora',
            'usuario_id' => '0'
        ]);

        
        Grupopermissao::create([
            'nome' => 'Clínica',
            'usuario_id' => '0'
        ]);

        
        Grupopermissao::create([
            'nome' => 'Escola',
            'usuario_id' => '0'
        ]);

        Grupopermissao::create([
            'id' => '99',
            'nome' => 'Tela Inicial',
            'usuario_id' => '0'
        ]);
        


        // Exibe uma informação no console durante o processo de seed
        $this->command->info('Grupo de Permissaos do Sistema Criadas');
    }

}

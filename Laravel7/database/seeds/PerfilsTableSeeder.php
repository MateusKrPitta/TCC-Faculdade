<?php

namespace database\seeds;

use Illuminate\Database\Seeder;
use App\Perfil;

class PerfilsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //
        Perfil::create([
            'id' => '0',
            'nome' => 'Padrao',
            'descricao' => 'Padrão Inicial'
        ]);

        // Exibe uma informação no console durante o processo de seed
        $this->command->info('Perfil Padrão Criado');

        Perfil::create([
            'nome' => 'Administradores',
            'descricao' => 'Administradores do sistema'
        ]);

        // Exibe uma informação no console durante o processo de seed
        $this->command->info('Perfil Administradores Criado');

        Perfil::create([
            'nome' => 'Financeiro',
            'descricao' => 'Responsável pelo departamento financeiro'
        ]);

        // Exibe uma informação no console durante o processo de seed
        $this->command->info('Perfil Financeiro Criado');

        Perfil::create([
            'nome' => 'Vendedores',
            'descricao' => 'Vendedores do sistema'
        ]);

        // Exibe uma informação no console durante o processo de seed
        $this->command->info('Perfil Vendedores Criado');
    }

}

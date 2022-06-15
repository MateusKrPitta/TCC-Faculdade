<?php

namespace database\seeds;

use Illuminate\Database\Seeder;
use App\Empresa;

class EmpresasTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //
        Empresa::create([
            'id' => '0',
            'nome' => 'Empresa Padrão',
            'razaosocial' => 'Empresa Teste',
            'cpfcnpj' => '0000000000',
            'rgie' => 'ISENTO',
            'status' => '1',
            'observacoes' => 'Empresa para testes e demonstrações',
            'usuario_id' => '0'
        ]);

        // Exibe uma informação no console durante o processo de seed
        $this->command->info('Empresa Teste Criada');

        Empresa::create([
            'nome' => 'Empresa Teste',
            'razaosocial' => 'Empresa2 Teste',
            'cpfcnpj' => '00000000002',
            'rgie' => 'ISENTO',
            'status' => '1',
            'observacoes' => 'Empresa2 para testes e demonstrações',
            'usuario_id' => '0'
        ]);

        // Exibe uma informação no console durante o processo de seed
        $this->command->info('Empresa2 Teste Criada');
    }

}

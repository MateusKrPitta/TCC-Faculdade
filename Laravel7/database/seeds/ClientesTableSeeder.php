<?php

namespace database\seeds;

use Illuminate\Database\Seeder;
use App\Cliente;

class ClientesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //
        Cliente::create([
            'empresa_id' => '0',
            'nome' => 'Cliente 1',
            'razaosocial' => 'Cliente Teste 1',
            'cpfcnpj' => '11111111111111',
            'rgie' => '1111111',
            'nascimento' => '2020-01-01',
            'observacoes' => '1',
            'usuario_id' => '0',
            'status' => '1'
        ]);

        // Exibe uma informação no console durante o processo de seed
        $this->command->info('Cliente 1 Criado');

        Cliente::create([
            'empresa_id' => '1',
            'nome' => 'Cliente 2',
            'razaosocial' => 'Cliente Teste 2',
            'cpfcnpj' => '2222222222222',
            'rgie' => '2222222',
            'nascimento' => '2020-02-02',
            'observacoes' => '222',
            'usuario_id' => '0',
            'status' => '1'
        ]);
        $this->command->info('Cliente 2 criado');
    }

}

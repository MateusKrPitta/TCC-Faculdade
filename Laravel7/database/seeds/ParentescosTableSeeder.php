<?php

namespace database\seeds;

use Illuminate\Database\Seeder;
use App\Parentesco;
use Illuminate\Support\Facades\DB;
use App\Empresa;

class ParentescosTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //
        $quantidadedeempresas = Empresa::all()->count();
// Exibe uma informação no console durante o processo de seed
        $this->command->info('Quantidade Empresas: ' . $quantidadedeempresas);
        for ($cont = 0; $cont < $quantidadedeempresas; $cont++) {
            Parentesco::create([
                'empresa_id' => $cont,
                'nome' => 'Pai',
                'senior' => '1',
                'usuario_id' => '0',
                'status' => '1'
            ]);
// Exibe uma informação no console durante o processo de seed
            $this->command->info('Parentesco: Pai Cadastrado na empresa: ' . $cont);

            Parentesco::create([
                'empresa_id' => $cont,
                'nome' => 'Mãe',
                'senior' => '1',
                'usuario_id' => '0',
                'status' => '1'
            ]);
// Exibe uma informação no console durante o processo de seed
            $this->command->info('Parentesco: Mãe Cadastrado na empresa: ' . $cont);

            Parentesco::create([
                'empresa_id' => $cont,
                'nome' => 'Sogro',
                'senior' => '1',
                'usuario_id' => '0',
                'status' => '1'
            ]);
// Exibe uma informação no console durante o processo de seed
            $this->command->info('Parentesco: Pai Cadastrado na empresa: ' . $cont);

            Parentesco::create([
                'empresa_id' => $cont,
                'nome' => 'Sogra',
                'senior' => '1',
                'usuario_id' => '0',
                'status' => '1'
            ]);
// Exibe uma informação no console durante o processo de seed
            $this->command->info('Parentesco: Sogra Cadastrado na empresa: ' . $cont);

            Parentesco::create([
                'empresa_id' => $cont,
                'nome' => 'Filho(a)',
                'senior' => '0',
                'usuario_id' => '0',
                'status' => '1'
            ]);
// Exibe uma informação no console durante o processo de seed
            $this->command->info('Parentesco: Filho(a) Cadastrado na empresa: ' . $cont);

            Parentesco::create([
                'empresa_id' => $cont,
                'nome' => 'Conjuge',
                'senior' => '0',
                'usuario_id' => '0',
                'status' => '1'
            ]);
// Exibe uma informação no console durante o processo de seed
            $this->command->info('Parentesco: Conjuge Cadastrado na empresa: ' . $cont);
        }
    }

}

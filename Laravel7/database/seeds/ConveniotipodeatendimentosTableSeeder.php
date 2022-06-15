<?php

namespace database\seeds;

use Illuminate\Database\Seeder;
use App\Conveniotipodeatendimento;
use Illuminate\Support\Facades\DB;
use App\Empresa;

class ConveniotipodeatendimentosTableSeeder extends Seeder {

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
            Conveniotipodeatendimento::create([
                'empresa_id' => $cont,
                'nome' => 'Consulta',
                'usuario_id' => '0',
                'status' => '1'
            ]);
// Exibe uma informação no console durante o processo de seed
            $this->command->info('Conveniotipodeatendimento: Consulta Cadastrado na empresa: ' . $cont);

            Conveniotipodeatendimento::create([
                'empresa_id' => $cont,
                'nome' => 'Exame',
                'usuario_id' => '0',
                'status' => '1'
            ]);
// Exibe uma informação no console durante o processo de seed
            $this->command->info('Conveniotipodeatendimento: Exame Cadastrado na empresa: ' . $cont);

            Conveniotipodeatendimento::create([
                'empresa_id' => $cont,
                'nome' => 'Compras',
                'usuario_id' => '0',
                'status' => '1'
            ]);
// Exibe uma informação no console durante o processo de seed
            $this->command->info('Conveniotipodeatendimento: Compras Cadastrado na empresa: ' . $cont);

            Conveniotipodeatendimento::create([
                'empresa_id' => $cont,
                'nome' => 'Outros',
                'usuario_id' => '0',
                'status' => '1'
            ]);
// Exibe uma informação no console durante o processo de seed
            $this->command->info('Conveniotipodeatendimento: Outros Cadastrado na empresa: ' . $cont);

        }
    }

}

<?php

namespace database\seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Empresa;

class VeiculoslinhaTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $quantidadedeempresas = Empresa::all()->count();
        for ($cont = 0; $cont < $quantidadedeempresas; $cont++) {

            DB::table('veiculoslinha')->insert([
                ['empresa_id' => $cont, 'linha' => 'NAO APLICAVEL', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'linha' => 'LINHA PESADA', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'linha' => 'LINHA LEVE', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'linha' => 'LINHA MEDIANA', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ]);

            // Exibe uma informação no console durante o processo de seed
            $this->command->info('Cores de Veículo Cadastradas na empresa: ' . $cont);
        }
    }

}

<?php

namespace database\seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Empresa;

class VeiculoseixoTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $quantidadedeempresas = Empresa::all()->count();
        for ($cont = 0; $cont < $quantidadedeempresas; $cont++) {

            DB::table('veiculoseixo')->insert([
                ['empresa_id' => $cont, 'eixo' => '', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'eixo' => '3º EIXO', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'eixo' => '4º EIXO', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'eixo' => '2º EIXO', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ]);

            // Exibe uma informação no console durante o processo de seed
            $this->command->info('Cores de Veículo Cadastradas na empresa: ' . $cont);
        }
    }

}

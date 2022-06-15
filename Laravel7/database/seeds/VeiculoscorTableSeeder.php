<?php

namespace database\seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Empresa;

class VeiculoscorTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $quantidadedeempresas = Empresa::all()->count();
        for ($cont = 0; $cont < $quantidadedeempresas; $cont++) {

            DB::table('veiculoscor')->insert([
                ['empresa_id' => $cont, 'cor' => 'BRANCO', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'cor' => 'PRETO', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'cor' => 'AZUL', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'cor' => 'AMARELO', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'cor' => 'VERMELHO', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'cor' => 'VERDE', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'cor' => 'ROXO', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'cor' => 'VINHO', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'cor' => 'CINZA', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'cor' => 'PRATA', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'cor' => 'LARANJA', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'cor' => 'FANTASIA', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'cor' => 'GRENA', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ]);

            // Exibe uma informação no console durante o processo de seed
            $this->command->info('Cores de Veículo Cadastradas na empresa: ' . $cont);
        }
    }

}

<?php

namespace database\seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Empresa;

class VeiculosespecieTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $quantidadedeempresas = Empresa::all()->count();
        for ($cont = 0; $cont < $quantidadedeempresas; $cont++) {

            DB::table('veiculosespecie')->insert([
                ['empresa_id' => $cont, 'especie' => 'PAS/MOTOCICLO', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'especie' => 'PAS/AUTOMOVEL', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'especie' => 'PAS/MICROONIBUS', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'especie' => 'PAS/REBOQUE', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'especie' => 'CAR/MOTOCICLO', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'especie' => 'CAR/CAMIONETE', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'especie' => 'CAR/CAMINHAO', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'especie' => 'CAR/REBOQUE', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'especie' => 'MIS/CAMIONETA', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'especie' => 'MIS/UTILITARIO', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'especie' => 'TRA/CAVALO', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'especie' => 'TRA/CAMINHAO', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'especie' => 'REB/BASCULANTE', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'especie' => 'REB/GRANELEIRA', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'especie' => 'REB/CAMARA FRIA', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'especie' => 'REBOQUE DOLLY', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'especie' => 'C/TRATOR', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'especie' => 'CAR/REBOQUE/TANQUE', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'especie' => 'REB/TANQUE', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ]);

            // Exibe uma informação no console durante o processo de seed
            $this->command->info('Cores de Veículo Cadastradas na empresa: ' . $cont);
        }
    }

}

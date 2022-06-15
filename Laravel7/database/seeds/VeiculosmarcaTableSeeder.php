<?php

namespace database\seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Empresa;

class VeiculosmarcaTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $quantidadedeempresas = Empresa::all()->count();
        for ($cont = 0; $cont < $quantidadedeempresas; $cont++) {

            DB::table('veiculosmarca')->insert([
                ['empresa_id' => $cont, 'marca' => 'CHEVROLET', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'VOLKSWAGEN', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'FIAT', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'MERCEDES-BENZ', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'CHANA', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'FORD', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'HYNDAI', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'KIA', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'TOYOTA', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'RENAULD', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'AGRALE', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'VOLVO', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'ISUKU', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'IVECO', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'UTILITARIOS AGRICOLA', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'TRAILER', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'RANDON', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'SCANIA', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'ONIBUS', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'OUTROS', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'UTILITARIOS PESADOS', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'MOTOR-HOME', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'MAN', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'NAVISTAR', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'SINOTRUK', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'SCHIFFER', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'GUERRA', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'MICHIGAN', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'FACCHINI', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'PASTRE', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'NOMA', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'LIBRELATO', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'KRONE', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'ROSSETTI', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'RODOLINEA', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'SCHIFFER', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'ANTONINI', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'THERMOSUL', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'IBIPORA', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'CARGO', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'RODOTEC', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'GOTTI', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'DAF', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'IMAVI', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'BLAYA SRB BC', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'TROPPA', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'RODOFORTSA', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'GOYDO', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'AIZ', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
                ['empresa_id' => $cont, 'marca' => 'ASFASTEEL', 'usuario_id' => 0, 'status' => 1, 'created_at' => date('Y-m-d'), 'updated_at' => date('Y-m-d')],
            ]);

            // Exibe uma informação no console durante o processo de seed
            $this->command->info('Cores de Veículo Cadastradas na empresa: ' . $cont);
        }
    }

}

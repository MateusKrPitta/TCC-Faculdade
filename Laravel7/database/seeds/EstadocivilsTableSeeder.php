<?php

namespace database\seeds;

use Illuminate\Database\Seeder;
use App\Estadocivil;
use Illuminate\Support\Facades\DB;
use App\Empresa;

class EstadocivilsTableSeeder extends Seeder {

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
            Estadocivil::create([
                'empresa_id' => $cont,
                'nome' => 'Solteiro(a)',
                'usuario_id' => '0',
                'status' => '1'
            ]);
// Exibe uma informação no console durante o processo de seed
            $this->command->info('Estadocivil: Solteiro Cadastrado na empresa: ' . $cont);

            Estadocivil::create([
                'empresa_id' => $cont,
                'nome' => 'Casado(a)',
                'usuario_id' => '0',
                'status' => '1'
            ]);
// Exibe uma informação no console durante o processo de seed
            $this->command->info('Estadocivil: Casado Cadastrado na empresa: ' . $cont);

            Estadocivil::create([
                'empresa_id' => $cont,
                'nome' => 'Separado(a)',
                'usuario_id' => '0',
                'status' => '1'
            ]);
// Exibe uma informação no console durante o processo de seed
            $this->command->info('Estadocivil: Separado Cadastrado na empresa: ' . $cont);

            Estadocivil::create([
                'empresa_id' => $cont,
                'nome' => 'Divorciado(a)',
                'usuario_id' => '0',
                'status' => '1'
            ]);
// Exibe uma informação no console durante o processo de seed
            $this->command->info('Estadocivil: Divorciado(a) Cadastrado na empresa: ' . $cont);

            Estadocivil::create([
                'empresa_id' => $cont,
                'nome' => 'Viúvo(a)',
                'usuario_id' => '0',
                'status' => '1'
            ]);
// Exibe uma informação no console durante o processo de seed
            $this->command->info('Estadocivil: Viúvo Cadastrado na empresa: ' . $cont);
        }
    }

}

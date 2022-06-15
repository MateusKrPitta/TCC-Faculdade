<?php

namespace database\seeds;

use Illuminate\Database\Seeder;
use App\Credenciadocategoria;
use Illuminate\Support\Facades\DB;

class CredenciadocategoriasTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //
        $quantidadedeempresas = DB::table('empresas')->count();
        for ($cont = 0; $cont < $quantidadedeempresas; $cont++) {
            Credenciadocategoria::create([
                'empresa_id' => $cont,
                'nome' => 'Academia',
                'usuario_id' => '0',
                'status' => '1'
            ]);
            Credenciadocategoria::create([
                'empresa_id' => $cont,
                'nome' => 'Clínica',
                'usuario_id' => '0',
                'status' => '1'
            ]);
            Credenciadocategoria::create([
                'empresa_id' => $cont,
                'nome' => 'Farmácia',
                'usuario_id' => '0',
                'status' => '1'
            ]);
            Credenciadocategoria::create([
                'empresa_id' => $cont,
                'nome' => 'Hospital',
                'usuario_id' => '0',
                'status' => '1'
            ]);
            Credenciadocategoria::create([
                'empresa_id' => $cont,
                'nome' => 'Laboratório',
                'usuario_id' => '0',
                'status' => '1'
            ]);
            
            
        }
    }

}

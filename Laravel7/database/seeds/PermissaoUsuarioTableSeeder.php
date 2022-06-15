<?php

namespace database\seeds;

use Illuminate\Database\Seeder;
use App\PermissaoUsuario;
use App\Permissao;

class PermissaoUsuarioTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //
        $listadepermissoes = Permissao::all('id');

        foreach ($listadepermissoes as $permissaoid){
            PermissaoUsuario::create([
                'usuario_id' => '0',
                'permissao_id' => $permissaoid->id,
                'usuario_id' => '0'
            ]);
        }


        /*
          PermissaoUsuario::create([
          'usuario_id' => '0',
          'permissao_id' => '1',
          'usuario_id' => '0'
          ]);

          PermissaoUsuario::create([
          'usuario_id' => '0',
          'permissao_id' => '2',
          'usuario_id' => '0'
          ]);
          PermissaoUsuario::create([
          'usuario_id' => '0',
          'permissao_id' => '3',
          'usuario_id' => '0'
          ]);

          PermissaoUsuario::create([
          'usuario_id' => '0',
          'permissao_id' => '4',
          'usuario_id' => '0'
          ]);
          PermissaoUsuario::create([
          'usuario_id' => '0',
          'permissao_id' => '5',
          'usuario_id' => '0'
          ]);
         */
        // Exibe uma informação no console durante o processo de seed
        $this->command->info('Permissões para o usuário registrada');
    }

}

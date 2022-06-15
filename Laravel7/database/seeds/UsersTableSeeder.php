<?php

namespace database\seeds;

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //
        User::create([
            'id' => '0',
            'empresa_id' => '0',
            'email' => 'admin@admin.com',
            'name' => 'Admin',
            'password' => bcrypt('Master123'),
            'usuario_id' => '0',
            'status' => '1'
        ]);

        // Exibe uma informação no console durante o processo de seed
        $this->command->info('Usuário ADMIN Criado');

        User::create([
            'empresa_id' => '1',
            'email' => 'usuario@usuario.com',
            'name' => 'Usuario',
            'password' => bcrypt('usuario'),
            'usuario_id' => '0',
            'status' => '1'
        ]);
        $this->command->info('Usuário basico criado');
    }

}

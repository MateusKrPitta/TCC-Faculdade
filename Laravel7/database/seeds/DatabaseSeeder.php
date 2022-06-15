<?php

use Illuminate\Database\Seeder;
use database\seeds\GrupopermissaosTableSeeder;
use database\seeds\PermissaosTableSeeder;
use database\seeds\ConveniotipodeatendimentosTableSeeder;
use database\seeds\UsersTableSeeder;
use database\seeds\EmpresasTableSeeder;
use database\seeds\PerfilsTableSeeder;
use database\seeds\PermissaoUsuarioTableSeeder;
use database\seeds\ClientesTableSeeder;
use database\seeds\FormadepagamentosTableSeeder;
use database\seeds\ParentescosTableSeeder;
use database\seeds\EstadocivilsTableSeeder;
use database\seeds\CredenciadocategoriasTableSeeder;
use database\seeds\VeiculoscarroceriaTableSeeder;
use database\seeds\VeiculoscategoriaTableSeeder;
use database\seeds\VeiculoscombustivelTableSeeder;
use database\seeds\VeiculoscorTableSeeder;
use database\seeds\VeiculoseixoTableSeeder;
use database\seeds\VeiculosespecieTableSeeder;
use database\seeds\VeiculoslinhaTableSeeder;
use database\seeds\VeiculosmarcaTableSeeder;
use database\seeds\VeiculospropriedadeTableSeeder;
use database\seeds\VeiculosrodadoTableSeeder;
use database\seeds\VeiculostipoTableSeeder;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        /*
         * Para criar um novo seed use:
         * php artisan make:seeder ClientesTableSeeder
         * 
         * A cada alteração é necessário executar o comando:
         * php composer.phar dump
         * 
         * Para carregar um separadamente use:
         * php artisan db:seed --class='database\seeds\PermissaosTableSeeder'
         */
        $this->call([
        EmpresasTableSeeder::class,
        PerfilsTableSeeder::class,
        UsersTableSeeder::class,
        GrupopermissaosTableSeeder::class,
        PermissaosTableSeeder::class,
        ConveniotipodeatendimentosTableSeeder::class,
        PermissaoUsuarioTableSeeder::class,
        CredenciadocategoriasTableSeeder::class,
        EstadocivilsTableSeeder::class,
        ParentescosTableSeeder::class,
        FormadepagamentosTableSeeder::class,
        ClientesTableSeeder::class,
        VeiculoscarroceriaTableSeeder::class,
        VeiculoscategoriaTableSeeder::class,
        VeiculoscombustivelTableSeeder::class,
        VeiculoscorTableSeeder::class,
        VeiculoseixoTableSeeder::class,
        VeiculosespecieTableSeeder::class,
        VeiculoslinhaTableSeeder::class,
        VeiculosmarcaTableSeeder::class,
        VeiculospropriedadeTableSeeder::class,
        VeiculosrodadoTableSeeder::class,
        VeiculostipoTableSeeder::class
        ]);
    }

}

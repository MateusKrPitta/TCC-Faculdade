<?php

namespace database\seeds;

use Illuminate\Database\Seeder;
use App\Formadepagamento;

class FormadepagamentosTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //
        Formadepagamento::create([
            'nome' => 'Dinheiro',
            'empresa_id' => '0',
            'parcela' => '1',
            'status' => '1',
            'observacao' => 'Forma de pagamento em dinheiro',
            'usuario_id' => '0'
        ]);

        // Exibe uma informação no console durante o processo de seed
        $this->command->info('Forma de pagamento Dinheiro');

        Formadepagamento::create([
            'nome' => 'Cartão Débito',
            'empresa_id' => '0',
            'parcela' => '1',
            'status' => '1',
            'observacao' => 'Forma de pagamento em cartão de débito',
            'usuario_id' => '0'
        ]);

        // Exibe uma informação no console durante o processo de seed
        $this->command->info('Forma de pagamento Cartão de Débito');


        Formadepagamento::create([
            'nome' => 'Cartão Crédito',
            'empresa_id' => '0',
            'parcela' => '10',
            'status' => '1',
            'observacao' => 'Forma de pagamento em cartão de crédito',
            'usuario_id' => '0'
        ]);

        // Exibe uma informação no console durante o processo de seed
        $this->command->info('Forma de pagamento Cartão de Crédito');


        Formadepagamento::create([
            'nome' => 'Boleto',
            'empresa_id' => '0',
            'parcela' => '1',
            'status' => '1',
            'observacao' => 'Forma de pagamento em Boleto',
            'usuario_id' => '0'
        ]);

        // Exibe uma informação no console durante o processo de seed
        $this->command->info('Forma de pagamento Boleto');


        Formadepagamento::create([
            'nome' => 'Boleto Parcelado',
            'empresa_id' => '0',
            'parcela' => '10',
            'status' => '1',
            'observacao' => 'Forma de pagamento Boleto Parcelado',
            'usuario_id' => '0'
        ]);

        // Exibe uma informação no console durante o processo de seed
        $this->command->info('Forma de pagamento Boleto Parcelado');

    }

}

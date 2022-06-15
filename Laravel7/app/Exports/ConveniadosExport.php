<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Conveniado;
use App\Usuario;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class ConveniadosExport implements FromCollection, ShouldAutoSize {

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection() {
        //
        //return Conveniado::all()->sortByDesc('id');
        return DB::table('conveniados')
                        ->leftJoin('cartaos', 'conveniados.id', '=', 'cartaos.conveniado_id')
                        ->leftJoin('users', 'conveniados.usuario_id', '=', 'users.id')
                        ->where('conveniados.empresa_id', Usuario::empresa())
                        ->where('cartaos.numeronocartao', '>', 0)
                        ->select('conveniados.id as id',
                                'conveniados.titular_id as titular_id',
                                'conveniados.nome as nome',
                                'conveniados.cpfcnpj as cpfcnpj',
                                'conveniados.rgie as rgie',
                                'conveniados.nascimento as nascimento',
                                'conveniados.tel1 as tel1',
                                'conveniados.tel2 as tel2',
                                'conveniados.sexo as sexo',
                                'conveniados.logradouro as logradouro',
                                'conveniados.numero as numero',
                                'conveniados.bairro as bairro',
                                'conveniados.complemento as complemento',
                                'conveniados.cidade as cidade',
                                'conveniados.estado as estado',
                                'conveniados.cep as cep',
                                'conveniados.observacao as observacao',
                                'cartaos.conveniado_id as conveniado_id',
                                'cartaos.nomenocartao as nomenocartao',
                                'cartaos.numeronocartao as numeronocartao',
                                'cartaos.datadeemissao as datadeemissao',
                                'cartaos.datadevalidade as datadevalidade',
                                'users.name as cadastro_usuario')
                        ->orderBy('cartaos.numeronocartao', 'desc')
                        ->orderBy('conveniados.id', 'desc')
                        ->get();
    }

}

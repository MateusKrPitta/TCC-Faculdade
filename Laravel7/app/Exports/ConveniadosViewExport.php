<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Conveniado;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use App\Usuario;

class ConveniadosViewExport implements FromView, ShouldAutoSize {

    public function view(): View {
        //return view('admin.conveniado.tabela', ['conveniados' => Conveniado::all(), 'listaconveniados' => Conveniado::all()]);
        return view('admin.conveniado.tabela', [
            'conveniados' =>
                    DB::table('conveniados')
                    ->leftJoin('cartaos', 'conveniados.id', '=', 'cartaos.conveniado_id')
                    ->where('conveniados.empresa_id', Usuario::empresa())
                    ->where('cartaos.numeronocartao', '>', 0)
                    ->select('conveniados.id as id',
                            'conveniados.empresa_id as empresa_id',
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
                            'conveniados.status as status',
                            'conveniados.observacao as observacao',
                            'conveniados.usuario_id as usuario_id',
                            'cartaos.conveniado_id as conveniado_id',
                            'cartaos.nomenocartao as nomenocartao',
                            'cartaos.numeronocartao as numeronocartao',
                            'cartaos.datadeemissao as datadeemissao',
                            'cartaos.datadevalidade as datadevalidade',
                            'cartaos.status as cartao_status',
                            'cartaos.usuario_id as cartao_usuario_id')
                    ->orderBy('cartaos.numeronocartao', 'desc')
                    ->orderBy('conveniados.id', 'desc')
                    ->get(), 
            'listaconveniados' =>
                    DB::table('conveniados')
                    ->where('empresa_id', Usuario::empresa())
                    ->orderBy('id')
                    ->get()
        ]);
    }

}

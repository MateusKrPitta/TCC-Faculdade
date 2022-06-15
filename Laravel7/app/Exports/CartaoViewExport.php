<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use App\Usuario;

class CartaoViewExport implements FromView, ShouldAutoSize {

    public function view(): View {
        $cartao = DB::table('cartaos')
                ->leftJoin('conveniados', 'cartaos.conveniado_id', '=', 'conveniados.id')
                ->where('cartaos.empresa_id', Usuario::empresa())
                ->where('cartaos.conveniado_id', $id)
                ->select('conveniados.id as id',
                        'conveniados.empresa_id as empresa_id',
                        'conveniados.titular_id as titular_id',
                        'conveniados.nome as nome',
                        'conveniados.nascimento as nascimento',
                        'conveniados.usuario_id as usuario_id',
                        'cartaos.conveniado_id as conveniado_id', 
                        'cartaos.nomenocartao as nomenocartao', 
                        'cartaos.numeronocartao as numeronocartao', 
                        'cartaos.datadeemissao as datadeemissao', 
                        'cartaos.datadevalidade as datadevalidade')
                ->first();
        $titular = DB::table('conveniados')
                ->where('conveniados.empresa_id', Usuario::empresa())
                ->where('conveniados.id', $cartao->titular_id)
                ->first();
        
        return view('admin.cartao.pdf', [
            'cartao' =>
                    $cartao, 
            'titular' =>
                    $titular
        ]);
    }

}

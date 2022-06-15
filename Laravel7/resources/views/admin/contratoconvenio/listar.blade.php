@extends('adminlte::page')

@section('content_header')
<h1>Listar Contratos</h1>
@stop

@section('content')
<?php
//Atribui os acessos do Usuario
use App\Usuario;

//Atribui os acessos do Usuario
$usuario = Usuario::find(\Illuminate\Support\Facades\Auth::user()->id);
foreach ($usuario->permissaos as $permis) {
    Gate::define($permis->nome, function($user) {
        return 1;
    });
}
?>
<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config" striped hoverable with-buttons compressed>
    @forelse ($contratoconvenios as $contratoconvenio)
    <tr>
        <td class="text-left">{{ $contratoconvenio->conveniado_nome}}</td>
        <td class="text-left">{{ $contratoconvenio->plano_nome}}</td>
        <td class="text-right">{{ number_format($contratoconvenio->valor,2,',','.')}}</td>
        <td class="text-left">{{ date('d/m/Y', strtotime($contratoconvenio->datadocontrato))}}</td>
        <td class="text-center">
            @if($contratoconvenio->status == 1)
            <span class="fas fa-check-square" style="color:green" aria-hidden="true"></span>
            @else
            <span class="fas fa-ban" style="color:red" aria-hidden="true"></span>
            @endif
        </td>
        <td class="text-center">
            <a href="/contratoconvenio/imprimircontrato/{{$contratoconvenio->id }}" title='Imprimir Contrato'>
                <span style="color:blue" class="far fa-file-alt" aria-hidden="true"></span>
            </a>
            @can('menu-convenio-contratoconvenio-editar')
            <a href="/contratoconvenio/editar/{{$contratoconvenio->id }}" title='Editar as Informações da Contrato'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @endcan
            @if ($contratoconvenio->status == "0")
            <a href="/contratoconvenio/ativar/{{$contratoconvenio->id }}" title='Ativa a Contrato'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else 
            <a href="/contratoconvenio/bloquear/{{$contratoconvenio->id }}" title='Bloqueia a Contrato'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            @can('menu-convenio-contratoconvenio-excluir')
            <a href="/contratoconvenio/apagar/{{$contratoconvenio->id }}" title='Apaga a Contrato'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
            @endcan
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop
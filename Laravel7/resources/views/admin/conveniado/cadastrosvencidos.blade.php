@extends('adminlte::page')

@section('content_header')
<h1>Listar Conveniados </h1>
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
    @forelse($conveniados as $conveniado)
    <tr>
        <td class="text-left"><a href="/conveniado/ficha/{{ $conveniado->id }}" title='Ficha do Conveniado'>{{ $conveniado->nome}}</a></td>
        <td class="text-left">
            <a href="/conveniado/ficha/{{ $conveniado->titular_id }}" title='Ficha do Conveniado'>
                @if ($conveniado->titular_id > 0) 
                @forelse($listaconveniados as $lista1)
                @if($lista1->id == $conveniado->titular_id)
                {{ $lista1->nome }} 
                @endif
                @empty
                @endforelse
                @endif
            </a>
        </td>
        <td class="text-left">{{ $conveniado->tel1}}</td>
        <td class="text-center">
            @if ($conveniado->status == "0") 
            <a title='Inativo'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            @if ($conveniado->status == "1")
            <a title='Ativo'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @endif
            @if ($conveniado->status == "2")
            <a title='Aguardando Contrato'>
                <span style="color:blue" class="fas fa-file-invoice" aria-hidden="true"></span>
            </a>
            @endif
            @if ($conveniado->status == "3")
            <a title='Aguardando Assinatura'>
                <span style="color:blueviolet" class="fas fa-marker" aria-hidden="true"></span>
            </a>
            @endif
            @if ($conveniado->status == "4")
            <a title='Aguardando Confirmação de Pagamento'>
                <span style="color:yellowgreen" class="fas fa-file-invoice-dollar" aria-hidden="true"></span>
            </a>
            @endif
        </td>
        <td class="text-right">
            @if ($conveniado->status == "1")
            <a href="/cartao/visualizar/{{ $conveniado->id }}" target="_blank" title='Cartão'>
                <span style="color:blue" class="fas fa-id-card" aria-hidden="true"></span>
            </a>
            <a href="/cartao/pdf/{{ $conveniado->id }}" target="_blank" title='Cartão'>
                <span style="color:red" class="fas fa-file-pdf" aria-hidden="true"></span>
            </a>
            @else
            <span style="color:gray" class="fas fa-id-card" aria-hidden="true"></span>
            <span style="color:gray" class="fas fa-file-pdf" aria-hidden="true"></span>
            @endif
            @if ($conveniado->titular_id > 0)  
            <span style="color:gray" class="fas fa-user-plus" aria-hidden="true"></span>
            @else
            <a href="/conveniado/cadastrar/{{ $conveniado->id }}" title='Adicionar Dependente'>
                <span style="color:blue" class="fas fa-user-plus" aria-hidden="true"></span>
            </a>
            @endif
            @can('menu-convenio-conveniado-editar')
            <a href="/conveniado/editar/{{ $conveniado->id }}" title='Editar as Informações do Conveniado'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @endcan
            @if ($conveniado->titular_id > 0)  
            <span style="color:gray" class="fas fa-ban" aria-hidden="true"></span>
            @else
            @if ($conveniado->status == "0") 
            <a href="/conveniado/ativar/{{ $conveniado->id }}" title='Ativa o Conveniado'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @endif
            @if ($conveniado->status == "1")
            <a href="/conveniado/bloquear/{{ $conveniado->id }}" title='Bloqueia o Conveniado'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            @if ($conveniado->status == "2")
            <a href="/contratoconvenio/cadastrar2/{{ $conveniado->id }}" title='Gerar Contrato'>
                <span style="color:blue" class="fas fa-file-invoice" aria-hidden="true"></span>
            </a>
            @endif
            @if ($conveniado->status == "3")
            <a href="/contratoconvenio/assinarcontrato/{{ $conveniado->id }}" title='Confirmar Assinatura'>
                <span style="color:blueviolet" class="fas fa-marker" aria-hidden="true"></span>
            </a>
            @endif
            @if ($conveniado->status == "4")
            <a href="/conveniado/confirmarpagamento/{{ $conveniado->id }}" title='Confirmar Pagamento'>
                <span style="color:yellowgreen" class="fas fa-file-invoice-dollar" aria-hidden="true"></span>
            </a>
            @endif
            @endif
            @can('menu-convenio-conveniado-excluir')
            <a href="/conveniado/apagar/{{ $conveniado->id }}" title='Apaga o Conveniado'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
            @endcan
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop
@extends('adminlte::page')

@section('content_header')
<h1>Relatório de Atendimentos</h1>
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
<x-adminlte-datatable id="table1" :heads="$cabecalho" :config="$config"  with-buttons compressed>
    @forelse($convenioatendimentos as $convenioatendimento)
    <tr>
        <td class="text-left">{{ $convenioatendimento->conveniado_nome}}</td>
        <td class="text-center">{{ $convenioatendimento->credenciado_nome}}</td>
        <td class="text-center">{{ $convenioatendimento->tipodeatendimento}}</td>
        <td class="text-center d-none d-xl-table-cell">{{ number_format($convenioatendimento->valor,2,',','.')}}</td>
        <td class="text-center d-none d-xl-table-cell">{{ $convenioatendimento->nomedoresponsavel}}</td>
        <td class="text-center">{{ $convenioatendimento->data }}</td>
        <!--
        <td class="text-center">{{ implode('/', array_reverse(explode('-', $convenioatendimento->data)))}}</td>
        -->
        <td class="text-center d-none d-xl-table-cell">
            @if ($convenioatendimento->status == "0") 
            <a title='Inativo'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            @if ($convenioatendimento->status == "1")
            <a title='Ativo'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @endif
        </td>
        <td class="text-center d-none d-xl-table-cell">
            @can('menu-convenio-convenioatendimento-editar')
            <a href="/convenioatendimento/editar/{{ $convenioatendimento->id }}" title='Editar as Informações do Conveniado'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @endcan
            @if ($convenioatendimento->status == "0") 
            <a href="/convenioatendimento/ativar/{{$convenioatendimento->id }}" title='Ativa o Atendimento do Conveniado'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @endif
            @if ($convenioatendimento->status == "1")
            <a href="/convenioatendimento/bloquear/{{ $convenioatendimento->id }}" title='Bloqueia o Atendimento do Conveniado'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
            @can('menu-convenio-convenioatendimento-excluir')
            <a href="/convenioatendimento/apagar/{{ $convenioatendimento->id }}" title='Apaga o Atendimento do Conveniado'>
                <span style="color:red" class="fas fa-trash" aria-hidden="true"></span>
            </a>
            @endcan
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop
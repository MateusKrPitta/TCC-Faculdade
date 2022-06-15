@extends('adminlte::page')

@section('content_header')
<h1>Listar Planos </h1>
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
    @forelse($planos as $plano)
    <tr>
        <td class="text-left">{{$plano->nome}}</td>
        <td class="text-right">{{number_format($plano->valor,2,',','.')}}</td>
        <td class="text-left">{{$plano->tempodeduracao}}</td>
        <td class="text-left">{{$plano->quantidadedependentes}}</td>
        <td class="text-center">
            @if ($plano->status == 1)
            <span class="fas fa-check-square" aria-hidden="true"></span>
            @else
            <span class="fas fa-ban" aria-hidden="true"></span>
            @endif
        </td>

        <td class="text-center">
            @can('menu-convenio-plano-editar')
            <a href="/plano/editar/{{ $plano->id }}" title='Editar as Informações do Plano'>
                <span style="color:orange" class="fas fa-pen-square" aria-hidden="true"></span>
            </a>
            @endcan
            @if ($plano->status == "0")
            <a href="/plano/ativar/{{ $plano->id }}" title='Ativa o Plano'>
                <span style="color:green" class="fas fa-check-square" aria-hidden="true"></span>
            </a>
            @else
            <a href="/plano/bloquear/{{ $plano->id }}" title='Bloqueia o Plano'>
                <span style="color:red" class="fas fa-ban" aria-hidden="true"></span>
            </a>
            @endif
        </td>
    </tr>
    @empty
    @endforelse
</x-adminlte-datatable>

@stop